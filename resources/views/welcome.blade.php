<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Vélocité - Bike Rental Platform</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Ajout de la police Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    </head>
    <body class="antialiased bg-gray-50 font-sans">
        <!-- Header amélioré -->
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex justify-between items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600 hover:text-indigo-800 transition-colors duration-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Vélocité
                    </a>

                    <div class="flex space-x-6 items-center">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-indigo-500 transition-colors duration-300 font-medium">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-500 transition-colors duration-300 font-medium">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors duration-300 shadow-sm font-medium">
                                        Register
                                    </a>

    </head>
    <body class="antialiased bg-gray-50">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex justify-between items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600">Vélocité</a>

                    <div class="flex space-x-6">
            @if (Route::has('login'))
                    @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-indigo-500 transition-colors">Dashboard</a>
                    @else
                                <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-500 transition-colors">Log in</a>

                        @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="text-gray-600 hover:text-indigo-500 transition-colors">Register</a>

                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </header>


        <!-- Hero Section avec animation -->
        <section class="bg-gradient-to-r from-indigo-50 via-blue-100 to-purple-50 py-20 relative overflow-hidden">
            <!-- Éléments décoratifs -->
            <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-indigo-100 rounded-full opacity-20"></div>
            <div class="absolute -top-20 -left-20 w-64 h-64 bg-blue-100 rounded-full opacity-20"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl font-serif">
                        <span class="block">Rent a Bike with</span>
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-600 animate-gradient-x">Vélocité</span>

        <!-- Hero Section with Search -->
        <section class="bg-gradient-to-r from-indigo-50 to-blue-50 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block">Rent a Bike with</span>
                        <span class="block text-indigo-600">Vélocité</span>

                    </h1>
                    <p class="mt-4 max-w-md mx-auto text-lg text-gray-600 sm:text-xl md:mt-6 md:max-w-3xl">
                        Explore the city on two wheels. Find the perfect bike for your needs, whether it's for commuting, exercise, or adventure.
                    </p>


                    <!-- Search Form amélioré -->
                    <div class="mt-12 max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-lg">

                    <!-- Search Form -->
                    <div class="mt-12 max-w-2xl mx-auto">

                        <form action="{{ route('search.index') }}" method="GET" class="space-y-4 sm:space-y-0 sm:flex sm:gap-4">
                            <div class="flex-1">
                                <label for="q" class="sr-only">Search bikes</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                    </div>

                                    <input type="text" name="q" id="q" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" placeholder="Find bikes by name, type, or location...">

                                    <input type="text" name="q" id="q" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Find bikes by name, type, or location...">

                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>

                                    <select name="category_id" class="block w-full py-3 pl-3 pr-10 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md transition duration-150">

                                    <select name="category_id" class="block w-full py-3 pl-3 pr-10 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">

                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>

                                    <select name="location" class="block w-full py-3 pl-3 pr-10 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md transition duration-150">

                                    <select name="location" class="block w-full py-3 pl-3 pr-10 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">

                                        <option value="">All Locations</option>
                                        @foreach($popularLocations as $location)
                                            <option value="{{ $location }}">{{ $location }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <button type="submit" class="w-full sm:w-auto px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition-all duration-300 transform hover:scale-105">

                            <button type="submit" class="w-full sm:w-auto px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm">

                                Search
                            </button>
                        </form>

                        <div class="mt-6 text-sm text-gray-600 flex justify-center space-x-6">

                            <a href="{{ route('search.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center transition-colors duration-300">
                                Advanced Search
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                            <a href="{{ route('search.map') }}" class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center transition-colors duration-300">

                            <a href="{{ route('search.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                                Advanced Search
                            </a>
                            <a href="{{ route('search.map') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">

                                Map View
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Categories Section avec hover effect amélioré -->
        <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 font-serif">Bike Categories</h2>
            <p class="mt-3 max-w-2xl mx-auto text-gray-500">Choose from our wide range of bike categories for every type of rider</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($categories as $category)
                @php
                    $images = [
                        'Road Bike' => 'https://i.pinimg.com/236x/a4/14/8c/a4148cc38eb9dc229a15ba911287b3c1.jpg',
                        'Mountain Bike' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS8Y7yg0SjMElhG2B81CDAHq3qPDU7IyeAJ_w&s',
                        'City Bike' => 'https://a-bike.nl/wp-content/uploads/2017/11/a-bike-city-bike-woman-happy-to-cycle-iconic-bridge-amsterdam.jpg',
                        'Electric Bike' => 'https://travelwest.info/app/uploads/2024/06/Ecargo-image-1024x576.jpg',
                        'Hybrid Bike' => 'https://cdn.pixabay.com/photo/2017/01/20/00/30/bicycle-1997864_1280.jpg',
                        'Folding Bike' => 'https://hips.hearstapps.com/hmg-prod/images/ride-folding-bikes-6491fb43ae3de.jpg?crop=0.502xw:1.00xh;0.179xw,0&resize=1200:*',
                        'Cargo Bike' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHmN0X27BxHsBH3SEg2J0ewlDpg6STd7b37A&s',
                        'Children\'s Bike' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrgkd8sxM0xfuqx193lw88QeV77hU6OGRPUQ&s',
                        'Tandem Bike' => 'https://brightspotcdn.byu.edu/dims4/default/b2d9176/2147483647/strip/true/crop/1080x1080+0+0/resize/840x840!/quality/90/?url=https%3A%2F%2Fbrigham-young-brightspot-us-east-2.s3.us-east-2.amazonaws.com%2Fd4%2F7f%2F43aa7f2ed657fedad3c687654acb%2F329087811-934347037978199-6429814563526290585-n.jpg',
                    ];
                    $img = $images[$category->name] ?? 'https://cdn.pixabay.com/photo/2017/02/01/12/50/bicycle-2026260_1280.jpg';
                @endphp
                <a href="{{ route('search.index', ['category_id' => $category->id]) }}"
                   class="group bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-100 hover:border-indigo-200 transition transform hover:-translate-y-1">
                    <div class="h-40 w-full rounded-t-xl overflow-hidden">
                        <img src="{{ $img }}" alt="{{ $category->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-gray-900 text-center group-hover:text-indigo-600 transition-colors duration-300">
                            {{ $category->name }}
                        </h3>
                        <p class="text-gray-500 mt-2 text-center group-hover:text-gray-700 transition-colors duration-300">
                            {{ Str::limit($category->description, 100) }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>


        <!-- Featured Bikes Section avec animation -->
        @if(isset($featuredBikes) && $featuredBikes->count() > 0)
            <section class="py-16 bg-gradient-to-b from-gray-50 to-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 font-serif">Featured Bikes</h2>
                        <p class="mt-3 max-w-2xl mx-auto text-gray-500">Top picks from our collection</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach($featuredBikes as $bike)
                            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 border border-gray-100 transform hover:-translate-y-1">
                                <a href="{{ route('bikes.show', $bike->id) }}" class="block relative overflow-hidden">
                                    <div class="h-56 bg-gray-100 relative">
                                        @if($bike->primaryImage)
                                            @if($bike->primaryImage && $bike->primaryImage->image_path)
                                                <img src="{{ asset('storage/bike_images/' . $bike->primaryImage->image_path) }}"
                                                     alt="{{ $bike->title }}"
                                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                            @else
                                                <img src="{{ asset('storage/bikes/placeholder.jpg') }}"
                                                     alt="No image available"
                                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                            @endif

        <!-- Categories Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center">Bike Categories</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach($categories as $category)
                        <a href="{{ route('search.index', ['category_id' => $category->id]) }}" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-300 border border-gray-100">
                            <div class="h-14 w-14 bg-indigo-50 rounded-full flex items-center justify-center mb-5 mx-auto">
                                @if($category->icon)
                                    <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}" class="h-7 w-7">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                    </svg>
                                @endif
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 text-center">{{ $category->name }}</h3>
                            <p class="text-gray-500 mt-3 text-center">{{ Str::limit($category->description, 100) }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Featured Bikes Section -->
        @if(isset($featuredBikes) && $featuredBikes->count() > 0)
            <section class="py-16 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center">Featured Bikes</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach($featuredBikes as $bike)
                            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 border border-gray-100">
                                <a href="{{ route('bikes.show', $bike->id) }}" class="block">
                                    <div class="h-56 bg-gray-100 relative">
                                        @if($bike->primaryImage)
                                            <img src="{{ asset('storage/bikes/placeholder.jpg') }}"
                                                alt="{{ $bike->title }}"
                                                class="w-full h-full object-cover">

                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                                <span class="text-gray-500">No image available</span>
                                            </div>
                                        @endif

                                        <div class="absolute top-3 right-3 bg-gradient-to-r from-indigo-600 to-blue-600 text-white py-1 px-3 text-xs font-semibold rounded-full shadow-sm">

                                        <div class="absolute top-3 right-3 bg-indigo-600 text-white py-1 px-3 text-xs font-semibold rounded-full">

                                            Featured
                                        </div>
                                    </div>
                                </a>
                                <div class="p-5">
                                    <div class="flex justify-between items-start">

                                        <a href="{{ route('bikes.show', $bike->id) }}" class="text-lg font-semibold text-gray-900 hover:text-indigo-600 transition-colors duration-300">{{ $bike->title }}</a>

                                        <a href="{{ route('bikes.show', $bike->id) }}" class="text-lg font-semibold text-gray-900 hover:text-indigo-600 transition-colors">{{ $bike->title }}</a>

                                        <span class="bg-indigo-100 text-indigo-800 text-xs px-2.5 py-0.5 rounded-full">{{ $bike->category->name }}</span>
                                    </div>
                                    <p class="text-gray-500 text-sm mt-3">{{ Str::limit($bike->description, 100) }}</p>
                                    <div class="flex justify-between items-center mt-5">
                                        <span class="text-indigo-600 font-semibold">€{{ number_format($bike->daily_rate, 2) }} <span class="text-gray-500 text-sm font-normal">/ day</span></span>

                                        <a href="{{ route('bikes.show', $bike->id) }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition-colors duration-300 flex items-center">
                                            View Details
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>

                                        <a href="{{ route('bikes.show', $bike->id) }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition-colors">View Details →</a>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif


        <!-- All Bikes Section avec animation -->
        <section id="bikes" class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-10">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 font-serif">Available Bikes</h2>
                        <p class="text-gray-500 mt-2">Browse our complete collection</p>
                    </div>
                    <a href="{{ route('search.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 mt-4 sm:mt-0">
                        View All Bikes
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                @if(isset($bikes) && $bikes->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach($bikes as $bike)
                            <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 border border-gray-100 transform hover:-translate-y-1 group">
                                <a href="{{ route('bikes.show', $bike->id) }}" class="block relative overflow-hidden">
                                    <div class="h-56 bg-gray-100 relative">
                                        @if($bike->primaryImage)
                                            <img src="{{ asset('storage/bikes/placeholder.jpg') }}"
                                                alt="{{ $bike->title }}"
                                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                                <span class="text-gray-500">No image available</span>
                                            </div>
                                        @endif
                                        @if($bike->is_electric)
                                            <div class="absolute top-3 right-3 bg-green-600 text-white py-1 px-2.5 text-xs font-semibold rounded-full shadow-sm">
                                                Electric
                                            </div>
                                        @endif
                                    </div>
                                </a>
                                <div class="p-5">
                                    <div class="flex justify-between items-start">
                                        <a href="{{ route('bikes.show', $bike->id) }}" class="text-lg font-semibold text-gray-900 hover:text-indigo-600 transition-colors duration-300">{{ $bike->title }}</a>
                                        <span class="text-sm text-gray-500">{{ $bike->location }}</span>
                                    </div>
                                    <div class="flex items-center mt-3 space-x-2">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <span class="text-sm text-gray-600 ml-1">
                                                {{ number_format($bike->average_rating, 1) }} ({{ $bike->rating_count }})
                                            </span>
                                        </div>
                                        <span class="text-gray-300">|</span>
                                        <span class="text-sm text-gray-600">{{ $bike->category->name }}</span>
                                    </div>
                                    <div class="flex justify-between items-center mt-5">
                                        <div>
                                            <span class="text-indigo-600 font-semibold">€{{ number_format($bike->daily_rate, 2) }}</span>
                                            <span class="text-gray-500 text-sm">/ day</span>
                                        </div>
                                        <a href="{{ route('bikes.show', $bike->id) }}" class="text-sm bg-gradient-to-r from-indigo-600 to-blue-600 text-white py-1.5 px-4 rounded-md hover:from-indigo-700 hover:to-blue-700 transition-all duration-300 shadow-sm">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-500 mt-4">No bikes available at the moment. Please check back later.</p>
                    </div>
                @endif
            </div>
        </section>

        <!-- How It Works Section améliorée -->
        <section class="py-16 bg-gradient-to-b from-white to-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 font-serif">How It Works</h2>
                    <p class="mt-3 max-w-2xl mx-auto text-gray-500">Renting a bike has never been easier</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div class="text-center bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100 transform hover:-translate-y-1">
                        <div class="bg-gradient-to-r from-indigo-100 to-blue-100 rounded-full h-20 w-20 flex items-center justify-center mx-auto mb-6 transition-all duration-300 group-hover:from-indigo-200 group-hover:to-blue-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">1. Find a Bike</h3>
                        <p class="text-gray-500">Browse our selection of bikes and choose the one that fits your needs.</p>
                    </div>
                    <div class="text-center bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100 transform hover:-translate-y-1">
                        <div class="bg-gradient-to-r from-indigo-100 to-blue-100 rounded-full h-20 w-20 flex items-center justify-center mx-auto mb-6 transition-all duration-300 group-hover:from-indigo-200 group-hover:to-blue-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">2. Book Your Rental</h3>
                        <p class="text-gray-500">Select your dates and request the bike. Owner will confirm your booking.</p>
                    </div>
                    <div class="text-center bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100 transform hover:-translate-y-1">
                        <div class="bg-gradient-to-r from-indigo-100 to-blue-100 rounded-full h-20 w-20 flex items-center justify-center mx-auto mb-6 transition-all duration-300 group-hover:from-indigo-200 group-hover:to-blue-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

        <!-- All Bikes Section -->
        <section id="bikes" class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-10">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4 sm:mb-0">Available Bikes</h2>
                    <a href="{{ route('search.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        View All Bikes
                    </a>
                </div>

                @if(isset($bikes) && $bikes->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach($bikes as $bike)
                            <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300 border border-gray-100">
                                <a href="{{ route('bikes.show', $bike->id) }}" class="block">
                                    <div class="h-56 bg-gray-100 relative">
                                        @if($bike->primaryImage)
                                            <img src="{{ asset('storage/bikes/placeholder.jpg') }}"
                                                alt="{{ $bike->title }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                                <span class="text-gray-500">No image available</span>
                                            </div>
                                        @endif
                                        @if($bike->is_electric)
                                            <div class="absolute top-3 right-3 bg-green-600 text-white py-1 px-2.5 text-xs font-semibold rounded-full">
                                                Electric
                                            </div>
                                        @endif
                                    </div>
                                </a>
                                <div class="p-5">
                                    <div class="flex justify-between items-start">
                                        <a href="{{ route('bikes.show', $bike->id) }}" class="text-lg font-semibold text-gray-900 hover:text-indigo-600 transition-colors">{{ $bike->title }}</a>
                                        <span class="text-sm text-gray-500">{{ $bike->location }}</span>
                                    </div>
                                    <div class="flex items-center mt-3 space-x-2">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <span class="text-sm text-gray-600 ml-1">
                                                {{ number_format($bike->average_rating, 1) }} ({{ $bike->rating_count }})
                                            </span>
                                        </div>
                                        <span class="text-gray-300">|</span>
                                        <span class="text-sm text-gray-600">{{ $bike->category->name }}</span>
                                    </div>
                                    <div class="flex justify-between items-center mt-5">
                                        <div>
                                            <span class="text-indigo-600 font-semibold">€{{ number_format($bike->daily_rate, 2) }}</span>
                                            <span class="text-gray-500 text-sm">/ day</span>
                                        </div>
                                        <a href="{{ route('bikes.show', $bike->id) }}" class="text-sm bg-indigo-600 text-white py-1.5 px-4 rounded-md hover:bg-indigo-700 transition-colors">View</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16">
                        <p class="text-gray-500">No bikes available at the moment. Please check back later.</p>
                    </div>
                @endif
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">How It Works</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div class="text-center">
                        <div class="bg-indigo-100 rounded-full h-20 w-20 flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">1. Find a Bike</h3>
                        <p class="text-gray-500">Browse our selection of bikes and choose the one that fits your needs.</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-indigo-100 rounded-full h-20 w-20 flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">2. Book Your Rental</h3>
                        <p class="text-gray-500">Select your dates and request the bike. Owner will confirm your booking.</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-indigo-100 rounded-full h-20 w-20 flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-900 mb-3">3. Enjoy Your Ride</h3>
                        <p class="text-gray-500">Pick up the bike, explore, and drop it off at the end of your rental period.</p>
                    </div>
                </div>
            </div>
        </section>


        <!-- CTA Section avec animation -->
        <section class="py-16 bg-gradient-to-r from-indigo-600 to-blue-600 relative overflow-hidden">
            <!-- Éléments décoratifs -->
            <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-white rounded-full opacity-10"></div>
            <div class="absolute -top-20 -left-20 w-64 h-64 bg-white rounded-full opacity-10"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <h2 class="text-3xl font-extrabold text-white mb-5 font-serif">Ready to start riding?</h2>
                <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto">Join Vélocité today and discover the freedom of cycling.</p>
                <div class="inline-flex rounded-md shadow">
                    @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50 transition-all duration-300 transform hover:scale-105 shadow-sm">
                            Sign Up Now
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('search.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50 transition-all duration-300 transform hover:scale-105 shadow-sm">
                            Find a Bike
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>

        <!-- CTA Section -->
        <section class="py-16 bg-indigo-600">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-extrabold text-white mb-5">Ready to start riding?</h2>
                <p class="text-xl text-indigo-100 mb-8">Join Vélocité today and discover the freedom of cycling.</p>
                <div class="inline-flex rounded-md shadow">
                    @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50 transition-colors">
                            Sign Up Now
                        </a>
                    @else
                        <a href="{{ route('search.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50 transition-colors">
                            Find a Bike

                        </a>
                    @endguest
                </div>
            </div>
        </section>


<!-- Footer -->
<footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Branding -->
            <div>
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Vélocité
                </h3>
                <p class="text-gray-400 text-sm">The best bike rental platform for your urban and outdoor adventures.</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Home</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Browse Bikes</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">How It Works</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Pricing</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Support</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">FAQ</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Contact Us</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Privacy Policy</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Terms of Service</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Contact</h3>
                <ul class="space-y-2 text-gray-400">
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        +1 (555) 123-4567
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        hello@velocite.com
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="border-t border-gray-800 mt-10 pt-6 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-400 text-sm mb-4 md:mb-0">&copy; {{ date('Y') }} Vélocité. All rights reserved.</p>
            <div class="flex space-x-6">
                <!-- Facebook -->
                <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                    <span class="sr-only">Facebook</span>
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                    </svg>
                </a>
                <!-- Instagram -->
                <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                    <span class="sr-only">Instagram</span>
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.75 2A5.75 5.75 0 002 7.75v8.5A5.75 5.75 0 007.75 22h8.5A5.75 5.75 0 0022 16.25v-8.5A5.75 5.75 0 0016.25 2h-8.5zM4.5 7.75a3.25 3.25 0 013.25-3.25h8.5a3.25 3.25 0 013.25 3.25v8.5a3.25 3.25 0 01-3.25 3.25h-8.5a3.25 3.25 0 01-3.25-3.25v-8.5zm11.25-.5a1 1 0 112 0 1 1 0 01-2 0zM12 8a4 4 0 100 8 4 4 0 000-8zm-2.5 4a2.5 2.5 0 115 0 2.5 2.5 0 01-5 0z" clip-rule="evenodd" />
                    </svg>
                </a>
                <!-- Twitter -->
                <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                    <span class="sr-only">Twitter</span>
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M19.633 7.997c.013.176.013.354.013.531 0 5.409-4.117 11.646-11.646 11.646-2.313 0-4.468-.672-6.28-1.826a8.2 8.2 0 006.06-1.699A4.108 4.108 0 013.52 13.7a5.18 5.18 0 001.85-.07 4.104 4.104 0 01-3.292-4.025v-.052a4.135 4.135 0 001.853.513A4.105 4.105 0 012.8 6.14a11.648 11.648 0 008.457 4.285 4.63 4.63 0 01-.102-.94A4.105 4.105 0 0115.26 5.6a8.027 8.027 0 002.605-.996 4.093 4.093 0 01-1.805 2.263 8.23 8.23 0 002.36-.642 8.809 8.809 0 01-2.087 2.172z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</footer>

<!-- Optional: Back to top button -->
<button onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-6 right-6 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-lg focus:outline-none">
    ↑
</button>

<!-- Scripts (if any) -->
<script>
    // Exemple de script
    console.log("Page loaded");
</script>

</body>
</html>

        <!-- Footer -->
        <footer class="bg-white py-8 border-t border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <p class="text-gray-500">&copy; {{ date('Y') }} Vélocité. All rights reserved.</p>
                    </div>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">About</a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">Privacy</a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">Terms</a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">Contact</a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>

