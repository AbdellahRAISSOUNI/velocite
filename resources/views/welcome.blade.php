<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Vélocité - Bike Rental Platform</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-white">
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex justify-between items-center">
                    <a href="{{ route('home') }}" class="text-3xl font-bold text-blue-600">Vélocité</a>

                    <div class="flex space-x-4">
            @if (Route::has('login'))
                    @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                    @else
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Log in</a>

                        @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600">Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section with Search -->
        <section class="bg-blue-50 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block">Rent a Bike with</span>
                        <span class="block text-blue-600">Vélocité</span>
                    </h1>
                    <p class="mt-3 max-w-md mx-auto text-base text-gray-600 sm:text-lg md:mt-5 md:text-xl md:max-w-2xl">
                        Explore the city on two wheels. Find the perfect bike for your needs, whether it's for commuting, exercise, or adventure.
                    </p>

                    <!-- Search Form -->
                    <div class="mt-10 max-w-xl mx-auto">
                        <form action="{{ route('search.index') }}" method="GET" class="sm:flex sm:shadow-lg rounded-md">
                            <div class="flex-1 min-w-0 px-4 py-3 bg-white rounded-l-md">
                                <label for="q" class="sr-only">Search bikes</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                                    </div>
                                    <input type="text" name="q" id="q" class="block w-full pl-10 pr-3 py-2 border-0 focus:ring-0 focus:border-blue-500 text-gray-900 placeholder-gray-500 rounded-md" placeholder="Find bikes by name, type, or location...">
                                </div>
                </div>

                            <div class="mt-3 sm:mt-0 sm:ml-0">
                                <div class="grid grid-cols-2 gap-0">
                                    <div class="col-span-1">
                                        <select name="category_id" class="block w-full border-0 py-3 pl-3 pr-10 text-base focus:outline-none focus:ring-0 sm:text-sm border-r border-gray-200">
                                            <option value="">All Categories</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-span-1">
                                        <select name="location" class="block w-full border-0 py-3 pl-3 pr-10 text-base focus:outline-none focus:ring-0 sm:text-sm">
                                            <option value="">All Locations</option>
                                            @foreach($popularLocations as $location)
                                                <option value="{{ $location }}">{{ $location }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="mt-3 w-full px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:flex-shrink-0 sm:rounded-l-none sm:rounded-r-md">
                                Search
                            </button>
                        </form>

                        <div class="mt-3 text-sm text-gray-600 flex justify-center space-x-4">
                            <a href="{{ route('search.index') }}" class="text-blue-600 hover:text-blue-800">
                                Advanced Search
                            </a>
                            <a href="{{ route('search.map') }}" class="text-blue-600 hover:text-blue-800">
                                Map View
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Bike Categories</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($categories as $category)
                        <a href="{{ route('search.index', ['category_id' => $category->id]) }}" class="bg-gray-50 rounded-lg shadow-sm p-4 hover:shadow-md transition-shadow">
                            <div class="h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                                @if($category->icon)
                                    <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}" class="h-6 w-6">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                    </svg>
                                @endif
                            </div>
                            <h3 class="text-lg font-medium text-gray-900">{{ $category->name }}</h3>
                            <p class="text-sm text-gray-600 mt-2">{{ Str::limit($category->description, 100) }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Featured Bikes Section -->
        @if(isset($featuredBikes) && $featuredBikes->count() > 0)
            <section class="py-12 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Featured Bikes</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($featuredBikes as $bike)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                                <a href="{{ route('bikes.show', $bike->id) }}" class="block">
                                    <div class="h-48 bg-gray-200 relative">
                                        @if($bike->primaryImage)
                                            <img src="{{ asset('storage/' . $bike->primaryImage->image_path) }}"
                                                alt="{{ $bike->title }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <span class="text-gray-400">No image available</span>
                                            </div>
                                        @endif
                                        <div class="absolute top-0 right-0 bg-blue-600 text-white py-1 px-3 text-sm font-semibold">
                                            Featured
                                        </div>
                                    </div>
                                </a>
                                <div class="p-4">
                                    <div class="flex justify-between items-start">
                                        <a href="{{ route('bikes.show', $bike->id) }}" class="text-lg font-semibold text-gray-900 hover:text-blue-600">{{ $bike->title }}</a>
                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">{{ $bike->category->name }}</span>
                                    </div>
                                    <p class="text-gray-600 text-sm mt-2">{{ Str::limit($bike->description, 100) }}</p>
                                    <div class="flex justify-between items-center mt-4">
                                        <span class="text-blue-600 font-semibold">€{{ number_format($bike->daily_rate, 2) }} / day</span>
                                        <a href="{{ route('bikes.show', $bike->id) }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">View Details →</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- All Bikes Section -->
        <section id="bikes" class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Available Bikes</h2>
                    <a href="{{ route('search.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        View All Bikes
                    </a>
                            </div>

                @if(isset($bikes) && $bikes->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($bikes as $bike)
                            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                                <a href="{{ route('bikes.show', $bike->id) }}" class="block">
                                    <div class="h-48 bg-gray-200 relative">
                                        @if($bike->primaryImage)
                                            <img src="{{ asset('storage/' . $bike->primaryImage->image_path) }}"
                                                alt="{{ $bike->title }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <span class="text-gray-400">No image available</span>
                                            </div>
                                        @endif
                                        @if($bike->is_electric)
                                            <div class="absolute top-0 right-0 bg-green-600 text-white py-1 px-3 text-xs font-semibold">
                                                Electric
                                            </div>
                                        @endif
                                    </div>
                                </a>
                                <div class="p-4">
                                    <div class="flex justify-between items-start">
                                        <a href="{{ route('bikes.show', $bike->id) }}" class="text-lg font-semibold text-gray-900 hover:text-blue-600">{{ $bike->title }}</a>
                                        <span class="text-sm text-gray-500">{{ $bike->location }}</span>
                                    </div>
                                    <div class="flex items-center mt-1">
                                        <span class="text-yellow-400 mr-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                                        </span>
                                        <span class="text-sm text-gray-600">
                                            {{ number_format($bike->average_rating, 1) }} ({{ $bike->rating_count }})
                                        </span>
                                        <span class="mx-2 text-gray-300">|</span>
                                        <span class="text-sm text-gray-600">{{ $bike->category->name }}</span>
                                    </div>
                                    <div class="flex justify-between items-center mt-4">
                            <div>
                                            <span class="text-blue-600 font-semibold">€{{ number_format($bike->daily_rate, 2) }}</span>
                                            <span class="text-gray-600 text-sm">/ day</span>
                                        </div>
                                        <a href="{{ route('bikes.show', $bike->id) }}" class="bg-blue-600 text-white text-sm py-1 px-3 rounded hover:bg-blue-700">View</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-500">No bikes available at the moment. Please check back later.</p>
                    </div>
                @endif
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-900 text-center mb-10">How It Works</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="bg-blue-100 rounded-full h-16 w-16 flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">1. Find a Bike</h3>
                        <p class="text-gray-600">Browse our selection of bikes and choose the one that fits your needs.</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-blue-100 rounded-full h-16 w-16 flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">2. Book Your Rental</h3>
                        <p class="text-gray-600">Select your dates and request the bike. Owner will confirm your booking.</p>
                            </div>
                    <div class="text-center">
                        <div class="bg-blue-100 rounded-full h-16 w-16 flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">3. Enjoy Your Ride</h3>
                        <p class="text-gray-600">Pick up the bike, explore, and drop it off at the end of your rental period.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-12 bg-blue-600">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-extrabold text-white mb-4">Ready to start riding?</h2>
                <p class="text-xl text-blue-100 mb-6">Join Vélocité today and discover the freedom of cycling.</p>
                <div class="inline-flex rounded-md shadow">
                    @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50">
                            Sign Up Now
                        </a>
                    @else
                        <a href="{{ route('search.index') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50">
                            Find a Bike
                        </a>
                    @endguest
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-100 py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <p class="text-gray-600">&copy; {{ date('Y') }} Vélocité. All rights reserved.</p>
                    </div>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-600 hover:text-blue-600">About</a>
                        <a href="#" class="text-gray-600 hover:text-blue-600">Privacy</a>
                        <a href="#" class="text-gray-600 hover:text-blue-600">Terms</a>
                        <a href="#" class="text-gray-600 hover:text-blue-600">Contact</a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
