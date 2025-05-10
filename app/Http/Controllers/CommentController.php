<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\RentalComment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the comments for a rental.
     */
    public function index(string $rentalId)
    {
        $rental = Rental::with(['bike', 'bike.owner', 'comments.user'])->findOrFail($rentalId);

        // Check if user is authorized to view this rental
        if (Auth::id() !== $rental->renter_id && Auth::id() !== $rental->bike->owner_id) {
            abort(403, 'Unauthorized action.');
        }

        // Get all visible comments based on user role
        $isOwner = Auth::id() === $rental->bike->owner_id;
        
        // Get public comments that are visible to both parties
        $publicComments = $rental->comments()
            ->where('is_private', false)
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Get private comments visible to the current user
        $privateComments = $rental->comments()
            ->where('is_private', true)
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Combine comments
        $comments = $publicComments->merge($privateComments)->sortBy('created_at');

        // Determine if both parties have commented or sufficient time has passed
        $clientHasCommented = $rental->comments()->where('user_id', $rental->renter_id)->exists();
        $partnerHasCommented = $rental->comments()->where('user_id', $rental->bike->owner_id)->exists();
        $bothHaveCommented = $clientHasCommented && $partnerHasCommented;
        
        $oneWeekPassed = Carbon::parse($rental->created_at)->addWeek()->isPast();
        $showAllComments = $bothHaveCommented || $oneWeekPassed;

        return view('comments.index', compact('rental', 'comments', 'showAllComments', 'clientHasCommented', 'partnerHasCommented'));
    }

    /**
     * Show the form for creating a new comment.
     */
    public function create(string $rentalId)
    {
        $rental = Rental::with(['bike', 'bike.owner'])->findOrFail($rentalId);

        // Check if user is authorized to comment on this rental
        if (Auth::id() !== $rental->renter_id && Auth::id() !== $rental->bike->owner_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('comments.create', compact('rental'));
    }

    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, string $rentalId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'is_private' => 'nullable|boolean',
        ]);

        $rental = Rental::findOrFail($rentalId);

        // Check if user is authorized to comment on this rental
        if (Auth::id() !== $rental->renter_id && Auth::id() !== $rental->bike->owner_id) {
            abort(403, 'Unauthorized action.');
        }

        // Begin transaction
        DB::beginTransaction();

        try {
            // Create the comment
            $comment = $rental->comments()->create([
                'user_id' => Auth::id(),
                'content' => $request->content,
                'is_private' => $request->has('is_private') && $request->is_private ? true : false,
            ]);

            // If the comment is not private, create a notification for the other party
            if (!$comment->is_private) {
                $recipientId = Auth::id() === $rental->renter_id ? $rental->bike->owner_id : $rental->renter_id;
                
                $notification = new Notification();
                $notification->user_id = $recipientId;
                $notification->type = 'new_comment';
                $notification->notifiable_id = $comment->id;
                $notification->notifiable_type = get_class($comment);
                $notification->content = Auth::user()->name . ' has added a comment to ' . 
                    (Auth::id() === $rental->renter_id ? 'your bike rental' : 'their rental of your bike');
                $notification->is_read = false;
                $notification->link = Auth::id() === $rental->renter_id 
                    ? route('partner.rentals.show', $rental->id)
                    : route('rentals.show', $rental->id);
                $notification->save();
            }

            DB::commit();

            return redirect()->route(Auth::id() === $rental->renter_id ? 'rentals.show' : 'partner.rentals.show', $rental->id)
                ->with('success', 'Comment added successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while adding your comment. Please try again.');
        }
    }

    /**
     * Update the specified comment.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'is_private' => 'nullable|boolean',
        ]);

        $comment = RentalComment::findOrFail($id);

        // Check if user is authorized to update this comment
        if (Auth::id() !== $comment->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Only allow updating comments that are less than 24 hours old
        if (Carbon::parse($comment->created_at)->addDay()->isPast()) {
            return back()->with('error', 'Comments can only be edited within 24 hours of creation.');
        }

        $comment->content = $request->content;
        $comment->is_private = $request->has('is_private') && $request->is_private ? true : false;
        $comment->save();

        return redirect()->route(Auth::id() === $comment->rental->renter_id ? 'rentals.show' : 'partner.rentals.show', $comment->rental_id)
            ->with('success', 'Comment updated successfully.');
    }

    /**
     * Remove the specified comment.
     */
    public function destroy(string $id)
    {
        $comment = RentalComment::findOrFail($id);

        // Check if user is authorized to delete this comment
        if (Auth::id() !== $comment->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Only allow deleting comments that are less than 24 hours old
        if (Carbon::parse($comment->created_at)->addDay()->isPast()) {
            return back()->with('error', 'Comments can only be deleted within 24 hours of creation.');
        }

        $rentalId = $comment->rental_id;
        $comment->delete();

        return redirect()->route(Auth::id() === $comment->rental->renter_id ? 'rentals.show' : 'partner.rentals.show', $rentalId)
            ->with('success', 'Comment deleted successfully.');
    }
}
