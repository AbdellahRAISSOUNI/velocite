<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\BikeRating;
use App\Models\Rental;
use App\Models\User;
use App\Models\UserRating;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RatingController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the rating form for a bike.
     */
    public function showBikeRatingForm(string $rentalId)
    {
        $rental = Rental::with(['bike', 'bikeRating'])->findOrFail($rentalId);

        // Check if user is authorized to rate this rental
        if (Auth::id() !== $rental->renter_id) {
            abort(403, 'Unauthorized action.');
        }

        // Check if rental is completed
        if ($rental->status !== 'completed') {
            return redirect()->route('rentals.show', $rental->id)
                ->with('error', 'You can only rate completed rentals');
        }

        // Check if user has already rated this bike
        if ($rental->bikeRating()->exists()) {
            return redirect()->route('rentals.show', $rental->id)
                ->with('error', 'You have already rated this bike');
        }

        return view('ratings.bike-form', compact('rental'));
    }

    /**
     * Store a new bike rating.
     */
    public function storeBikeRating(Request $request, string $rentalId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:500',
        ]);

        $rental = Rental::findOrFail($rentalId);

        // Check if user is authorized to rate this rental
        if (Auth::id() !== $rental->renter_id) {
            abort(403, 'Unauthorized action.');
        }

        // Check if rental is completed and not already rated
        if ($rental->status !== 'completed') {
            return back()->with('error', 'You can only rate completed rentals');
        }

        if ($rental->bikeRating()->exists()) {
            return back()->with('error', 'You have already rated this bike');
        }

        // Begin transaction
        DB::beginTransaction();

        try {
            // Create the bike rating
            $rating = $rental->bikeRating()->create([
                'bike_id' => $rental->bike_id,
                'user_id' => Auth::id(),
                'rating' => $request->rating,
                'review' => $request->review,
            ]);

            // Update the bike's average rating
            $bike = $rental->bike;
            $bike->rating_count = $bike->rating_count + 1;
            $bike->average_rating = $bike->ratings()->avg('rating');
            $bike->save();

            // Create notification for the bike owner
            $notification = new Notification();
            $notification->user_id = $rental->bike->owner_id;
            $notification->type = 'new_bike_rating';
            $notification->notifiable_id = $rating->id;
            $notification->notifiable_type = get_class($rating);
            $notification->content = Auth::user()->name . ' has rated your bike "' . $rental->bike->title . '" ' . $request->rating . ' out of 5';
            $notification->is_read = false;
            $notification->link = route('partner.rentals.show', $rental->id);
            $notification->save();

            DB::commit();

            return redirect()->route('rentals.show', $rental->id)
                ->with('success', 'Bike rating submitted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while submitting your rating. Please try again.');
        }
    }

    /**
     * Display the rating form for a user (partner).
     */
    public function showUserRatingForm(string $rentalId)
    {
        $rental = Rental::with(['bike', 'bike.owner', 'userRatings'])->findOrFail($rentalId);

        // Check if user is authorized to rate
        if (!in_array(Auth::id(), [$rental->renter_id, $rental->bike->owner_id])) {
            abort(403, 'Unauthorized action.');
        }

        // Check if rental is completed
        if ($rental->status !== 'completed') {
            return redirect()->route('rentals.show', $rental->id)
                ->with('error', 'You can only rate completed rentals');
        }

        // Determine who is rating whom
        $isClient = Auth::id() === $rental->renter_id;
        $ratedUserId = $isClient ? $rental->bike->owner_id : $rental->renter_id;

        // Check if user has already rated this user for this rental
        $existingRating = $rental->userRatings()
            ->where('rater_id', Auth::id())
            ->where('rated_user_id', $ratedUserId)
            ->first();

        if ($existingRating) {
            return redirect()->route('rentals.show', $rental->id)
                ->with('error', 'You have already rated this user');
        }

        $ratedUser = User::findOrFail($ratedUserId);
        return view('ratings.user-form', compact('rental', 'ratedUser'));
    }

    /**
     * Store a new user rating.
     */
    public function storeUserRating(Request $request, string $rentalId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:500',
        ]);

        $rental = Rental::findOrFail($rentalId);

        // Check if user is authorized to rate
        if (!in_array(Auth::id(), [$rental->renter_id, $rental->bike->owner_id])) {
            abort(403, 'Unauthorized action.');
        }

        // Check if rental is completed
        if ($rental->status !== 'completed') {
            return back()->with('error', 'You can only rate completed rentals');
        }

        // Determine who is rating whom
        $isOwner = Auth::id() === $rental->bike->owner_id;
        $ratedUserId = $isOwner ? $rental->renter_id : $rental->bike->owner_id;

        // Check if user has already rated this user for this rental
        $existingRating = $rental->userRatings()
            ->where('rater_id', Auth::id())
            ->where('rated_user_id', $ratedUserId)
            ->first();

        if ($existingRating) {
            return back()->with('error', 'You have already rated this user');
        }

        // Begin transaction
        DB::beginTransaction();

        try {
            // Create the user rating
            $rating = $rental->userRatings()->create([
                'rater_id' => Auth::id(),
                'rated_user_id' => $ratedUserId,
                'rating' => $request->rating,
                'review' => $request->review,
            ]);

            // Update user's profile average rating
            $ratedUser = User::findOrFail($ratedUserId);
            if ($ratedUser->profile) {
                $ratedUser->profile->rating_count = $ratedUser->profile->rating_count + 1;
                $averageRating = UserRating::where('rated_user_id', $ratedUserId)->avg('rating');
                $ratedUser->profile->average_rating = $averageRating;
                $ratedUser->profile->save();
            }

            // Create notification for the rated user
            $notification = new Notification();
            $notification->user_id = $ratedUserId;
            $notification->type = 'new_user_rating';
            $notification->notifiable_id = $rating->id;
            $notification->notifiable_type = get_class($rating);
            $notification->content = Auth::user()->name . ' has rated you ' . $request->rating . ' out of 5';
            $notification->is_read = false;
            $notification->link = route(
                $ratedUser->hasRole('partner') ? 'partner.rentals.show' : 'rentals.show',
                $rental->id
            );
            $notification->save();

            DB::commit();

            return redirect()->route('rentals.show', $rental->id)
                ->with('success', 'User rating submitted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while submitting your rating. Please try again: ' . $e->getMessage());
        }
    }
}
