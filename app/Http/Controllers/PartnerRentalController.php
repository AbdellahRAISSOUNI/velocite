<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Rental;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PartnerRentalController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:partner']);
    }

    /**
     * Display a listing of the partner's bike rentals.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $status = $request->status;

        $query = Rental::whereHas('bike', function ($query) use ($user) {
            $query->where('owner_id', $user->id);
        })->with(['bike', 'renter', 'bike.primaryImage']);

        // Apply status filter if provided
        if ($status && in_array($status, ['pending', 'confirmed', 'ongoing', 'completed', 'cancelled'])) {
            $query->where('status', $status);
        }

        $rentals = $query->orderBy('created_at', 'desc')->paginate(10);

        // Get rental counts by status
        $statusCounts = [
            'pending' => Rental::whereHas('bike', function ($query) use ($user) {
                $query->where('owner_id', $user->id);
            })->where('status', 'pending')->count(),
            'confirmed' => Rental::whereHas('bike', function ($query) use ($user) {
                $query->where('owner_id', $user->id);
            })->where('status', 'confirmed')->count(),
            'ongoing' => Rental::whereHas('bike', function ($query) use ($user) {
                $query->where('owner_id', $user->id);
            })->where('status', 'ongoing')->count(),
            'completed' => Rental::whereHas('bike', function ($query) use ($user) {
                $query->where('owner_id', $user->id);
            })->where('status', 'completed')->count(),
            'cancelled' => Rental::whereHas('bike', function ($query) use ($user) {
                $query->where('owner_id', $user->id);
            })->where('status', 'cancelled')->count(),
        ];

        return view('partner.rentals.index', compact('rentals', 'status', 'statusCounts'));
    }

    /**
     * Display the specified rental.
     */
    public function show(string $id)
    {
        $rental = Rental::with(['bike', 'renter', 'renter.profile', 'bike.primaryImage', 'bike.category', 'comments'])
            ->findOrFail($id);

        // Check if the authenticated user owns the bike in this rental
        if (Auth::id() !== $rental->bike->owner_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('partner.rentals.show', compact('rental'));
    }

    /**
     * Approve a rental request.
     */
    public function approve(string $id)
    {
        $rental = Rental::with('bike', 'renter')->findOrFail($id);

        // Check if the authenticated user owns the bike in this rental
        if (Auth::id() !== $rental->bike->owner_id) {
            abort(403, 'Unauthorized action.');
        }

        // Check if rental can be approved
        if ($rental->status !== 'pending') {
            return back()->with('error', 'This rental cannot be approved');
        }

        // Check for any conflicting approved rentals
        if (!$this->checkAvailability($rental->bike_id, $rental->start_date, $rental->end_date, $rental->id)) {
            return back()->with('error', 'There is a scheduling conflict with another approved rental');
        }

        // Update rental status
        $rental->status = 'confirmed';
        $rental->save();

        // Create notification for the renter
        $notification = new Notification();
        $notification->user_id = $rental->renter_id;
        $notification->type = 'rental_approved';
        $notification->notifiable_id = $rental->id;
        $notification->notifiable_type = Rental::class;
        $notification->content = 'Your rental request for "' . $rental->bike->title . '" has been approved';
        $notification->is_read = false;
        $notification->link = route('rentals.show', $rental->id);
        $notification->save();

        return redirect()->route('partner.rentals.show', $rental->id)
            ->with('success', 'Rental request approved successfully.');
    }

    /**
     * Reject a rental request.
     */
    public function reject(Request $request, string $id)
    {
        $request->validate([
            'rejection_reason' => 'nullable|string|max:500',
        ]);

        $rental = Rental::with('bike', 'renter')->findOrFail($id);

        // Check if the authenticated user owns the bike in this rental
        if (Auth::id() !== $rental->bike->owner_id) {
            abort(403, 'Unauthorized action.');
        }

        // Check if rental can be rejected
        if ($rental->status !== 'pending') {
            return back()->with('error', 'This rental cannot be rejected');
        }

        // Update rental status
        $rental->status = 'rejected';
        $rental->cancellation_reason = $request->rejection_reason;
        $rental->cancelled_at = now();
        $rental->save();

        // Create notification for the renter
        $notification = new Notification();
        $notification->user_id = $rental->renter_id;
        $notification->type = 'rental_rejected';
        $notification->notifiable_id = $rental->id;
        $notification->notifiable_type = Rental::class;
        $notification->content = 'Your rental request for "' . $rental->bike->title . '" has been rejected';
        $notification->is_read = false;
        $notification->link = route('rentals.show', $rental->id);
        $notification->save();

        return redirect()->route('partner.rentals.show', $rental->id)
            ->with('success', 'Rental request rejected successfully.');
    }

    /**
     * Mark a rental as started.
     */
    public function start(string $id)
    {
        $rental = Rental::with('bike', 'renter')->findOrFail($id);

        // Check if the authenticated user owns the bike in this rental
        if (Auth::id() !== $rental->bike->owner_id) {
            abort(403, 'Unauthorized action.');
        }

        // Check if rental can be marked as started
        if ($rental->status !== 'confirmed') {
            return back()->with('error', 'This rental cannot be marked as started');
        }

        // Update rental status
        $rental->status = 'ongoing';
        $rental->save();

        // Create notification for the renter
        $notification = new Notification();
        $notification->user_id = $rental->renter_id;
        $notification->type = 'rental_started';
        $notification->notifiable_id = $rental->id;
        $notification->notifiable_type = Rental::class;
        $notification->content = 'Your rental for "' . $rental->bike->title . '" has been marked as started';
        $notification->is_read = false;
        $notification->link = route('rentals.show', $rental->id);
        $notification->save();

        return redirect()->route('partner.rentals.show', $rental->id)
            ->with('success', 'Rental marked as started successfully.');
    }

    /**
     * Mark a rental as completed.
     */
    public function complete(string $id)
    {
        $rental = Rental::with('bike', 'renter')->findOrFail($id);

        // Check if the authenticated user owns the bike in this rental
        if (Auth::id() !== $rental->bike->owner_id) {
            abort(403, 'Unauthorized action.');
        }

        // Check if rental can be marked as completed
        if ($rental->status !== 'ongoing') {
            return back()->with('error', 'This rental cannot be marked as completed');
        }

        // Update rental status
        $rental->status = 'completed';
        $rental->save();

        // Create notification for the renter
        $notification = new Notification();
        $notification->user_id = $rental->renter_id;
        $notification->type = 'rental_completed';
        $notification->notifiable_id = $rental->id;
        $notification->notifiable_type = Rental::class;
        $notification->content = 'Your rental for "' . $rental->bike->title . '" has been marked as completed. Please rate your experience.';
        $notification->is_read = false;
        $notification->link = route('rentals.show', $rental->id);
        $notification->save();

        return redirect()->route('partner.rentals.show', $rental->id)
            ->with('success', 'Rental marked as completed successfully.');
    }

    /**
     * Add a comment to a rental.
     */
    public function addComment(Request $request, string $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $rental = Rental::findOrFail($id);

        // Check if the authenticated user owns the bike in this rental
        if (Auth::id() !== $rental->bike->owner_id) {
            abort(403, 'Unauthorized action.');
        }

        // Create the comment
        $comment = $rental->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'is_private' => false,
        ]);

        // Create notification for the renter
        $notification = new Notification();
        $notification->user_id = $rental->renter_id;
        $notification->type = 'new_comment';
        $notification->notifiable_id = $comment->id;
        $notification->notifiable_type = get_class($comment);
        $notification->content = Auth::user()->name . ' has added a comment to your rental for "' . $rental->bike->title . '"';
        $notification->is_read = false;
        $notification->link = route('rentals.show', $rental->id);
        $notification->save();

        return redirect()->route('partner.rentals.show', $rental->id)
            ->with('success', 'Comment added successfully.');
    }

    /**
     * Check if a bike is available for the given dates (excluding the current rental).
     */
    private function checkAvailability($bikeId, $startDate, $endDate, $currentRentalId = null)
    {
        // Check if bike has any unavailable dates in the range
        $unavailableDates = DB::table('bike_availabilities')
            ->where('bike_id', $bikeId)
            ->where('is_available', false)
            ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->exists();

        if ($unavailableDates) {
            return false;
        }

        // Check if there are any confirmed or ongoing rentals during the requested period
        $query = Rental::where('bike_id', $bikeId)
            ->whereIn('status', ['confirmed', 'ongoing'])
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('start_date', '<=', $startDate)
                              ->where('end_date', '>=', $endDate);
                    });
            });

        // Exclude the current rental if provided
        if ($currentRentalId) {
            $query->where('id', '!=', $currentRentalId);
        }

        return !$query->exists();
    }
}
