<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\BikeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Show the search form with default results.
     */
    public function index(Request $request)
    {
        $categories = BikeCategory::all();
        $query = Bike::where('is_available', true)
                    ->with(['owner', 'category', 'primaryImage', 'availabilities']);

        // Apply filters from the request
        $bikes = $this->applyFilters($query, $request)
                    ->paginate(12)
                    ->withQueryString();

        // Get min and max price for the filter
        $priceRange = Bike::where('is_available', true)
                         ->select(DB::raw('MIN(daily_rate) as min_price, MAX(daily_rate) as max_price'))
                         ->first();

        // Get popular locations for the filter
        $popularLocations = Bike::select('location')
                              ->where('is_available', true)
                              ->groupBy('location')
                              ->orderByRaw('COUNT(*) DESC')
                              ->limit(10)
                              ->pluck('location');

        return view('search.index', compact(
            'bikes',
            'categories',
            'priceRange',
            'popularLocations'
        ));
    }

    /**
     * Show the map view with bike locations.
     */
    public function map(Request $request)
    {
        $bikes = Bike::where('is_available', true)
                    ->whereNotNull('latitude')
                    ->whereNotNull('longitude')
                    ->with(['owner', 'category', 'primaryImage']);

        // Apply filters
        $bikes = $this->applyFilters($bikes, $request)->get();

        $categories = BikeCategory::all();

        return view('search.map', compact('bikes', 'categories'));
    }

    /**
     * Search for bikes within a certain radius of coordinates.
     */
    public function nearby(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'nullable|numeric|min:1|max:100',
        ]);

        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $radius = $request->radius ?? 10;
        $unit = $request->unit ?? 'km';

        $bikes = Bike::where('is_available', true)
                    ->nearby($latitude, $longitude, $radius, $unit)
                    ->with(['owner', 'category', 'primaryImage'])
                    ->limit(20)
                    ->get();

        if ($request->wantsJson()) {
            return response()->json([
                'bikes' => $bikes,
                'count' => $bikes->count(),
            ]);
        }

        return view('search.nearby', compact('bikes', 'latitude', 'longitude', 'radius', 'unit'));
    }

    /**
     * Apply search filters to the query.
     */
    private function applyFilters($query, Request $request)
    {
        // Filter by search term
        if ($request->has('q') && !empty($request->q)) {
            $searchTerm = $request->q;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('brand', 'like', "%{$searchTerm}%")
                  ->orWhere('model', 'like', "%{$searchTerm}%");
            });
        }

        // Filter by location
        if ($request->has('location') && !empty($request->location)) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        // Filter by category
        if ($request->has('category_id') && !empty($request->category_id)) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by price range
        if ($request->has('min_price') && is_numeric($request->min_price)) {
            $query->where('daily_rate', '>=', $request->min_price);
        }

        if ($request->has('max_price') && is_numeric($request->max_price)) {
            $query->where('daily_rate', '<=', $request->max_price);
        }

        // Filter by electric bikes
        if ($request->has('is_electric') && $request->is_electric == 1) {
            $query->where('is_electric', true);
        }

        // Filter by rating
        if ($request->has('min_rating') && is_numeric($request->min_rating)) {
            $query->where('average_rating', '>=', $request->min_rating);
        }

        // Filter by date availability
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->start_date;
            $endDate = $request->end_date;

            // Exclude bikes with unavailable dates in the selected range
            $query->whereDoesntHave('availabilities', function ($q) use ($startDate, $endDate) {
                $q->whereBetween('date', [$startDate, $endDate])
                  ->where('is_available', false);
            });

            // Exclude bikes with confirmed rentals in the selected range
            $query->whereDoesntHave('rentals', function ($q) use ($startDate, $endDate) {
                $q->whereIn('status', ['confirmed', 'ongoing'])
                  ->where(function ($q) use ($startDate, $endDate) {
                      $q->whereBetween('start_date', [$startDate, $endDate])
                        ->orWhereBetween('end_date', [$startDate, $endDate])
                        ->orWhere(function ($q) use ($startDate, $endDate) {
                            $q->where('start_date', '<=', $startDate)
                              ->where('end_date', '>=', $endDate);
                        });
                  });
            });
        }

        // Apply sorting
        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case 'price_asc':
                    $query->orderBy('daily_rate', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('daily_rate', 'desc');
                    break;
                case 'rating_desc':
                    $query->orderBy('average_rating', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            // Default sort is newest
            $query->orderBy('created_at', 'desc');
        }

        return $query;
    }
}
