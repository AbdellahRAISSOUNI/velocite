<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AgentDashboardController;
use App\Http\Controllers\ClientDashboardController;
use App\Http\Controllers\PartnerDashboardController;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\PartnerRentalController;
use App\Http\Controllers\Auth\ClientRegistrationController;
use App\Http\Controllers\Auth\PartnerRegistrationController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Bike details page
Route::get('/bikes/{id}', [HomeController::class, 'show'])->name('bikes.show');

// Search routes
Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/search/map', [SearchController::class, 'map'])->name('search.map');
Route::get('/search/nearby', [SearchController::class, 'nearby'])->name('search.nearby');

// Role-specific registration routes
Route::get('/register/client', [ClientRegistrationController::class, 'create'])
    ->middleware('guest')
    ->name('register.client');

Route::post('/register/client', [ClientRegistrationController::class, 'store'])
    ->middleware('guest');

Route::get('/register/partner', [PartnerRegistrationController::class, 'create'])
    ->middleware('guest')
    ->name('register.partner');

Route::post('/register/partner', [PartnerRegistrationController::class, 'store'])
    ->middleware('guest');

// Role-specific dashboard routes
Route::get('/dashboard', function () {
    // Redirect based on user role
    $user = Auth::user();
    if ($user) {
        switch ($user->role) {
            case 'partner':
                return redirect()->route('partner.dashboard');
            case 'agent':
                return redirect()->route('agent.dashboard');
            case 'admin':
                return redirect()->route('admin.dashboard');
            default:
                return redirect()->route('client.dashboard');
        }
    }
    return redirect()->route('login');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard/client', [ClientDashboardController::class, 'index'])
    ->middleware(['auth', 'role:client'])
    ->name('client.dashboard');

Route::get('/dashboard/partner', [PartnerDashboardController::class, 'index'])
    ->middleware(['auth', 'role:partner'])
    ->name('partner.dashboard');

Route::get('/dashboard/agent', [AgentDashboardController::class, 'index'])
    ->middleware(['auth', 'role:agent'])
    ->name('agent.dashboard');

Route::get('/dashboard/admin', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

// Client rental routes
Route::middleware(['auth', 'role:client'])->group(function () {
    // Rental management
    Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
    Route::get('/rentals/create', [RentalController::class, 'create'])->name('rentals.create');
    Route::post('/rentals', [RentalController::class, 'store'])->name('rentals.store');
    Route::get('/rentals/{id}', [RentalController::class, 'show'])->name('rentals.show');
    Route::post('/rentals/{id}/cancel', [RentalController::class, 'cancel'])->name('rentals.cancel');
    Route::post('/rentals/{id}/rate', [RentalController::class, 'rate'])->name('rentals.rate');
    
    // Rating routes
    Route::get('/rentals/{rentalId}/rate-bike', [RatingController::class, 'showBikeRatingForm'])->name('rentals.rate.bike.form');
    Route::post('/rentals/{rentalId}/rate-bike', [RatingController::class, 'storeBikeRating'])->name('rentals.rate.bike');
    Route::get('/rentals/{rentalId}/rate-user', [RatingController::class, 'showUserRatingForm'])->name('rentals.rate.user.form');
    Route::post('/rentals/{rentalId}/rate-user', [RatingController::class, 'storeUserRating'])->name('rentals.rate.user');
    
    // Comment routes
    Route::get('/rentals/{rentalId}/comments', [CommentController::class, 'index'])->name('rentals.comments');
    Route::get('/rentals/{rentalId}/comments/create', [CommentController::class, 'create'])->name('rentals.comments.create');
    Route::post('/rentals/{rentalId}/comments', [CommentController::class, 'store'])->name('rentals.comments.store');
    Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// Partner bike management routes
Route::middleware(['auth', 'role:partner'])->group(function () {
    // Standard resource routes for bike management
    Route::resource('partner/bikes', BikeController::class)->names([
        'index' => 'partner.bikes.index',
        'create' => 'partner.bikes.create',
        'store' => 'partner.bikes.store',
        'show' => 'partner.bikes.show',
        'edit' => 'partner.bikes.edit',
        'update' => 'partner.bikes.update',
        'destroy' => 'partner.bikes.destroy',
    ]);

    // Additional bike management routes
    Route::post('partner/bikes/{bike}/toggle-availability', [BikeController::class, 'toggleAvailability'])
        ->name('partner.bikes.toggle-availability');

    // Availability management
    Route::get('partner/bikes/{bike}/availability', [BikeController::class, 'manageAvailability'])
        ->name('partner.bikes.availability');
    Route::post('partner/bikes/{bike}/availability', [BikeController::class, 'updateAvailability'])
        ->name('partner.bikes.update-availability');

    // Premium listing management
    Route::get('partner/bikes/{bike}/premium', [BikeController::class, 'createPremiumListing'])
        ->name('partner.bikes.premium');
    Route::post('partner/bikes/{bike}/premium', [BikeController::class, 'storePremiumListing'])
        ->name('partner.bikes.store-premium');

    // Partner rental management
    Route::get('partner/rentals', [PartnerRentalController::class, 'index'])->name('partner.rentals.index');
    Route::get('partner/rentals/{id}', [PartnerRentalController::class, 'show'])->name('partner.rentals.show');
    Route::post('partner/rentals/{id}/approve', [PartnerRentalController::class, 'approve'])->name('partner.rentals.approve');
    Route::post('partner/rentals/{id}/reject', [PartnerRentalController::class, 'reject'])->name('partner.rentals.reject');
    Route::post('partner/rentals/{id}/start', [PartnerRentalController::class, 'start'])->name('partner.rentals.start');
    Route::post('partner/rentals/{id}/complete', [PartnerRentalController::class, 'complete'])->name('partner.rentals.complete');
    Route::post('partner/rentals/{id}/comment', [PartnerRentalController::class, 'addComment'])->name('partner.rentals.comment');

    // Rating routes for partners
    Route::get('partner/rentals/{rentalId}/rate-user', [RatingController::class, 'showUserRatingForm'])->name('partner.rentals.rate.user.form');
    Route::post('partner/rentals/{rentalId}/rate-user', [RatingController::class, 'storeUserRating'])->name('partner.rentals.rate.user');
    
    // Comment routes for partners
    Route::get('partner/rentals/{rentalId}/comments', [CommentController::class, 'index'])->name('partner.rentals.comments');
    Route::get('partner/rentals/{rentalId}/comments/create', [CommentController::class, 'create'])->name('partner.rentals.comments.create');
    Route::post('partner/rentals/{rentalId}/comments', [CommentController::class, 'store'])->name('partner.rentals.comments.store');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.picture.update');
});

require __DIR__.'/auth.php';
