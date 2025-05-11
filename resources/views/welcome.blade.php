<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Vélocité - Premium Bike Rentals</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    </head>
    <body class="antialiased bg-white dark:bg-gray-900 transition-colors duration-500">
        <!-- Back to top button -->
        <button id="back-to-top" class="fixed bottom-8 right-8 z-50 p-3 bg-gradient-to-r from-blue-600 to-cyan-500 text-white rounded-full shadow-xl hover:from-blue-700 hover:to-cyan-600 transition-all duration-300 transform translate-y-20 opacity-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </button>

        <!-- Floating particles -->
        <div id="particles-js" class="fixed inset-0 z-0 pointer-events-none"></div>

        <!-- Navbar -->
        <nav class="bg-white dark:bg-gray-800 shadow-lg sticky top-0 z-50 transition-colors duration-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent flex items-center">
                            <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_3Q1LjC.json" background="transparent" speed="1" style="width: 40px; height: 40px;" loop autoplay></lottie-player>
                            Vélocité
                        </a>
                    </div>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="{{ route('home') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-cyan-400 font-medium transition-colors duration-300 relative group">
                            Home
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 dark:bg-cyan-400 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="{{ route('search.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-cyan-400 font-medium transition-colors duration-300 relative group">
                            Browse Bikes
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 dark:bg-cyan-400 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-cyan-400 font-medium transition-colors duration-300 relative group">
                            How It Works
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 dark:bg-cyan-400 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-cyan-400 font-medium transition-colors duration-300 relative group">
                            About Us
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 dark:bg-cyan-400 transition-all duration-300 group-hover:w-full"></span>
                        </a>

                        <!-- Theme Toggle -->
                        <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg p-2.5 transition-colors duration-300 group relative">
                            <svg id="theme-toggle-dark-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                            <svg id="theme-toggle-light-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                            <span class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-blue-600 dark:bg-cyan-400 transition-all duration-300 group-hover:w-4/5" style="transform: translateX(-50%);"></span>
                        </button>

                        <!-- Auth Links -->
                        <div class="flex items-center space-x-4">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-md font-medium bg-gradient-to-r from-blue-600 to-cyan-500 text-white hover:from-blue-700 hover:to-cyan-600 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                                        </svg>
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-cyan-400 font-medium transition-colors duration-300 relative group">
                                        Log in
                                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 dark:bg-cyan-400 transition-all duration-300 group-hover:w-full"></span>
                                    </a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="px-4 py-2 rounded-md font-medium bg-gradient-to-r from-blue-600 to-cyan-500 text-white hover:from-blue-700 hover:to-cyan-600 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6z" />
                                            </svg>
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="md:hidden flex items-center">
                        <button id="mobile-menu-button" type="button" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-cyan-400 focus:outline-none transition-colors duration-300">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-gray-800 transition-all duration-500 ease-in-out transform -translate-y-full opacity-0">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-cyan-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-300">Home</a>
                    <a href="{{ route('search.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-cyan-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-300">Browse Bikes</a>
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-cyan-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-300">How It Works</a>
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-cyan-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-300">About Us</a>
                    
                    <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="block w-full px-4 py-2 text-center rounded-md font-medium bg-gradient-to-r from-blue-600 to-cyan-500 text-white hover:from-blue-700 hover:to-cyan-600 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-cyan-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-300">
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="block w-full mt-2 px-4 py-2 text-center rounded-md font-medium bg-gradient-to-r from-blue-600 to-cyan-500 text-white hover:from-blue-700 hover:to-cyan-600 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative bg-gradient-to-r from-blue-50 to-cyan-50 dark:from-gray-800 dark:to-gray-900 overflow-hidden transition-colors duration-500">
            <div class="absolute inset-0 opacity-20 dark:opacity-30">
                <div class="absolute inset-0 bg-[url('https://preview.redd.it/v0caqchbtn741.jpg?auto=webp&s=6f5a775a1b7b0c3d6f7b8a1e9a9b0c1e9b0c1e9b')] bg-cover bg-center mix-blend-multiply"></div>
            </div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative z-10">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl md:text-6xl animate__animated animate__fadeInDown">
                        <span class="block">Ride the City with</span>
                        <span class="block bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent animate__animated animate__fadeIn animate__delay-1s">Vélocité</span>
                    </h1>
                    <p class="mt-3 max-w-md mx-auto text-lg text-gray-600 dark:text-gray-300 sm:text-xl md:mt-5 md:max-w-3xl animate__animated animate__fadeIn animate__delay-1s">
                        Discover premium bikes for every adventure. From city commutes to mountain trails, find your perfect ride in seconds.
                    </p>
                    
                    <!-- Search Form -->
                    <div class="mt-10 max-w-2xl mx-auto animate__animated animate__fadeIn animate__delay-1s">
                        <form action="{{ route('search.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                            <div class="flex-1 bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl group">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 dark:text-gray-500 group-hover:text-blue-600 dark:group-hover:text-cyan-400 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" name="q" id="q" class="block w-full pl-10 pr-3 py-4 border-0 bg-transparent text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-0 focus:outline-none transition-colors duration-300" placeholder="Find bikes by name, type, or location...">
                                </div>
                            </div>
                            
                            <button type="submit" class="px-6 py-4 border border-transparent text-base font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-cyan-500 shadow-lg hover:from-blue-700 hover:to-cyan-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                                Search Bikes
                            </button>
                        </form>
                        
                        <div class="mt-4 flex justify-center space-x-6">
                            <a href="{{ route('search.index') }}" class="text-blue-600 dark:text-cyan-400 hover:text-blue-800 dark:hover:text-cyan-300 font-medium flex items-center transition-colors duration-300 group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 group-hover:rotate-6 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                                Advanced Search
                            </a>
                            <a href="{{ route('search.map') }}" class="text-blue-600 dark:text-cyan-400 hover:text-blue-800 dark:hover:text-cyan-300 font-medium flex items-center transition-colors duration-300 group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 group-hover:rotate-6 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                                Map View
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Animated waves -->
            <div class="absolute bottom-0 left-0 right-0 overflow-hidden">
                <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-16">
                    <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="fill-blue-100 dark:fill-gray-800"></path>
                    <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="fill-blue-100 dark:fill-gray-800"></path>
                    <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="fill-white dark:fill-gray-900"></path>
                </svg>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="py-16 bg-white dark:bg-gray-900 transition-colors duration-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white animate__animated animate__fadeIn">Explore Bike Categories</h2>
                    <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-600 dark:text-gray-300 animate__animated animate__fadeIn animate__delay-1s">
                        Find the perfect bike for your next adventure
                    </p>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($categories as $category)
                        <a href="{{ route('search.index', ['category_id' => $category->id]) }}" class="group relative bg-gray-50 dark:bg-gray-800 rounded-xl shadow-md overflow-hidden transition-all duration-500 hover:shadow-xl hover:-translate-y-2 animate__animated animate__fadeInUp">
                            <div class="aspect-w-16 aspect-h-9 bg-gradient-to-r from-blue-100 to-cyan-100 dark:from-gray-700 dark:to-gray-600 h-48 flex items-center justify-center">
                                @if($category->icon)
                                    <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}" class="h-20 w-20 object-contain transition-transform duration-500 group-hover:scale-110">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-blue-600 dark:text-cyan-400 transition-transform duration-500 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @endif
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ $category->name }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ Str::limit($category->description, 100) }}</p>
                                <div class="mt-4 flex items-center text-blue-600 dark:text-cyan-400 group-hover:text-blue-700 dark:group-hover:text-cyan-300 transition-colors duration-300">
                                    <span class="text-sm font-medium">Browse bikes</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Featured Bikes Section -->
        @if(isset($featuredBikes) && $featuredBikes->count() > 0)
            <section class="py-16 bg-gray-50 dark:bg-gray-800 transition-colors duration-500">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white animate__animated animate__fadeIn">Featured Bikes</h2>
                        <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-600 dark:text-gray-300 animate__animated animate__fadeIn animate__delay-1s">
                            Premium selections curated just for you
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach($featuredBikes as $bike)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                                <a href="{{ route('bikes.show', $bike->id) }}" class="block">
                                    <div class="h-48 bg-gray-200 relative">
                                        @if($bike->primaryImage)
                                            <img src="{{ asset('storage/bikes/placeholder.jpg') }}"
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
                                    @endif
                                </div>
                                <div class="p-6">
                                    <div class="flex justify-between items-start">
                                        <a href="{{ route('bikes.show', $bike->id) }}" class="text-xl font-bold text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-cyan-400 transition-colors duration-300">{{ $bike->title }}</a>
                                        <span class="bg-blue-100 dark:bg-gray-600 text-blue-800 dark:text-cyan-400 text-xs px-2 py-1 rounded-full">{{ $bike->category->name }}</span>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm mt-2">{{ Str::limit($bike->description, 80) }}</p>
                                    <div class="mt-4 flex items-center">
                                        <div class="flex items-center">
                                            <span class="text-yellow-400 mr-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            </span>
                                            <span class="text-sm text-gray-600 dark:text-gray-300">
                                                {{ number_format($bike->average_rating, 1) }} ({{ $bike->rating_count }})
                                            </span>
                                        </div>
                                        <span class="mx-2 text-gray-300">|</span>
                                        <span class="text-sm text-gray-600 dark:text-gray-300">{{ $bike->location }}</span>
                                    </div>
                                    <div class="mt-6 flex justify-between items-center">
                                        <div>
                                            <span class="text-blue-600 dark:text-cyan-400 font-bold text-lg">€{{ number_format($bike->daily_rate, 2) }}</span>
                                            <span class="text-gray-500 dark:text-gray-400 text-sm">/ day</span>
                                        </div>
                                        <a href="{{ route('bikes.show', $bike->id) }}" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-cyan-500 text-white text-sm font-medium rounded-lg hover:from-blue-700 hover:to-cyan-600 transition-all duration-300 transform hover:scale-105">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- How It Works Section -->
        <section class="py-16 bg-white dark:bg-gray-900 transition-colors duration-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white animate__animated animate__fadeIn">How Vélocité Works</h2>
                    <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-600 dark:text-gray-300 animate__animated animate__fadeIn animate__delay-1s">
                        Rent a bike in just a few simple steps
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="text-center animate__animated animate__fadeInLeft">
                        <div class="relative mx-auto mb-6">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-cyan-400 rounded-full opacity-20 blur-lg animate-pulse"></div>
                            <div class="relative bg-gradient-to-r from-blue-600 to-cyan-500 rounded-full h-24 w-24 flex items-center justify-center mx-auto shadow-lg hover:scale-110 transition-transform duration-500">
                                <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_80nu1m6q.json" background="transparent" speed="1" style="width: 60px; height: 60px;" loop autoplay></lottie-player>
                            </div>

                @if(isset($bikes) && $bikes->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($bikes as $bike)
                            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                                <a href="{{ route('bikes.show', $bike->id) }}" class="block">
                                    <div class="h-48 bg-gray-200 relative">
                                        @if($bike->primaryImage)
                                            <img src="{{ asset('storage/bikes/placeholder.jpg') }}"
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
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">2. Book With Ease</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Select your dates, confirm your booking, and get instant confirmation. No hidden fees, no hassle.
                        </p>
                    </div>
                    
                    <div class="text-center animate__animated animate__fadeInRight">
                        <div class="relative mx-auto mb-6">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-cyan-400 rounded-full opacity-20 blur-lg animate-pulse"></div>
                            <div class="relative bg-gradient-to-r from-blue-600 to-cyan-500 rounded-full h-24 w-24 flex items-center justify-center mx-auto shadow-lg hover:scale-110 transition-transform duration-500">
                                <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_obhph3sh.json" background="transparent" speed="1" style="width: 60px; height: 60px;" loop autoplay></lottie-player>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">3. Ride & Explore</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Pick up your bike and enjoy the freedom of the open road. Return it when you're done - it's that simple!
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-16 bg-gray-50 dark:bg-gray-800 transition-colors duration-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white animate__animated animate__fadeIn">What Our Riders Say</h2>
                    <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-600 dark:text-gray-300 animate__animated animate__fadeIn animate__delay-1s">
                        Join thousands of happy customers
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg transition-all duration-500 hover:shadow-xl hover:-translate-y-2 animate__animated animate__fadeInLeft">
                        <div class="flex items-center mb-4">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-600 to-cyan-500 flex items-center justify-center text-white font-bold">JD</div>
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-900 dark:text-white">Jean Dupont</h4>
                                <div class="flex">
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 italic">"Vélocité made my city exploration so easy! The bike was in perfect condition and the pickup process was seamless. Will definitely use again!"</p>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg transition-all duration-500 hover:shadow-xl hover:-translate-y-2 animate__animated animate__fadeInUp">
                        <div class="flex items-center mb-4">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-600 to-cyan-500 flex items-center justify-center text-white font-bold">SM</div>
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-900 dark:text-white">Sophie Martin</h4>
                                <div class="flex">
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 italic">"The electric bike I rented was amazing! Perfect for getting around the city without breaking a sweat. The app made everything so simple."</p>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg transition-all duration-500 hover:shadow-xl hover:-translate-y-2 animate__animated animate__fadeInRight">
                        <div class="flex items-center mb-4">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-600 to-cyan-500 flex items-center justify-center text-white font-bold">TL</div>
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-900 dark:text-white">Thomas Leroy</h4>
                                <div class="flex">
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 italic">"As a frequent traveler, I love using Vélocité in different cities. The bikes are always high quality and the customer service is excellent."</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-16 bg-gradient-to-r from-blue-600 to-cyan-500 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div class="animate__animated animate__fadeInLeft">
                        <div class="text-4xl font-bold mb-2" id="bikes-count">0</div>
                        <div class="text-xl">Bikes Available</div>
                    </div>
                    <div class="animate__animated animate__fadeInUp">
                        <div class="text-4xl font-bold mb-2" id="happy-riders">0</div>
                        <div class="text-xl">Happy Riders</div>
                    </div>
                    <div class="animate__animated animate__fadeInRight">
                        <div class="text-4xl font-bold mb-2" id="cities-covered">0</div>
                        <div class="text-xl">Cities Covered</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative py-20 bg-gradient-to-r from-blue-600 to-cyan-500 overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0 bg-[url('https://preview.redd.it/v0caqchbtn741.jpg?auto=webp&s=6f5a775a1b7b0c3d6f7b8a1e9a9b0c1e9b0c1e9b')] bg-cover bg-center mix-blend-overlay"></div>
            </div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-white sm:text-4xl animate__animated animate__fadeIn">
                        <span class="block">Ready to start your adventure?</span>
                    </h2>
                    <p class="mt-3 max-w-2xl mx-auto text-xl text-blue-100 animate__animated animate__fadeIn animate__delay-1s">
                        Join thousands of happy riders who discovered their city on two wheels.
                    </p>
                    <div class="mt-8 flex justify-center animate__animated animate__fadeIn animate__delay-1s">
                        @guest
                            <a href="{{ route('register') }}" class="px-8 py-4 border border-transparent text-base font-medium rounded-lg text-blue-600 bg-white hover:bg-blue-50 shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                Sign Up Now - It's Free
                            </a>
                        @else
                            <a href="{{ route('search.index') }}" class="px-8 py-4 border border-transparent text-base font-medium rounded-lg text-blue-600 bg-white hover:bg-blue-50 shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Browse Available Bikes
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-100 dark:bg-gray-800 transition-colors duration-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Vélocité</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Premium bike rentals for every adventure. Explore your city like never before.
                        </p>
                        <div class="mt-4 flex space-x-4">
                            <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-cyan-400 transition-colors duration-300">
                                <span class="sr-only">Facebook</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-cyan-400 transition-colors duration-300">
                                <span class="sr-only">Instagram</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-cyan-400 transition-colors duration-300">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-cyan-400 transition-colors duration-300">Home</a></li>
                            <li><a href="{{ route('search.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-cyan-400 transition-colors duration-300">Browse Bikes</a></li>
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-cyan-400 transition-colors duration-300">How It Works</a></li>
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-cyan-400 transition-colors duration-300">About Us</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Support</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-cyan-400 transition-colors duration-300">Help Center</a></li>
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-cyan-400 transition-colors duration-300">Safety</a></li>
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-cyan-400 transition-colors duration-300">Community Guidelines</a></li>
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-cyan-400 transition-colors duration-300">Contact Us</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Legal</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-cyan-400 transition-colors duration-300">Terms of Service</a></li>
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-cyan-400 transition-colors duration-300">Privacy Policy</a></li>
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-cyan-400 transition-colors duration-300">Cookie Policy</a></li>
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-cyan-400 transition-colors duration-300">GDPR</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                        &copy; {{ date('Y') }} Vélocité. All rights reserved.
                    </p>
                    <div class="mt-4 md:mt-0">
                        <button id="theme-toggle-footer" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg p-2.5 transition-colors duration-300">
                            <svg id="theme-toggle-dark-icon-footer" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                            <svg id="theme-toggle-light-icon-footer" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
        <script>
            // Mobile menu toggle
            document.getElementById('mobile-menu-button').addEventListener('click', function() {
                const menu = document.getElementById('mobile-menu');
                menu.classList.toggle('hidden');
                menu.classList.toggle('translate-y-0');
                menu.classList.toggle('opacity-100');
                menu.classList.toggle('-translate-y-full');
                menu.classList.toggle('opacity-0');
            });

            // Theme toggle
            const themeToggle = document.getElementById('theme-toggle');
            const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
            const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
            const themeToggleFooter = document.getElementById('theme-toggle-footer');
            const themeToggleDarkIconFooter = document.getElementById('theme-toggle-dark-icon-footer');
            const themeToggleLightIconFooter = document.getElementById('theme-toggle-light-icon-footer');

            // Change the icons inside the button based on previous settings
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                themeToggleLightIcon.classList.remove('hidden');
                themeToggleLightIconFooter.classList.remove('hidden');
                document.documentElement.classList.add('dark');
            } else {
                themeToggleDarkIcon.classList.remove('hidden');
                themeToggleDarkIconFooter.classList.remove('hidden');
                document.documentElement.classList.remove('dark');
            }

            const toggleTheme = () => {
                // Toggle icons
                themeToggleDarkIcon.classList.toggle('hidden');
                themeToggleLightIcon.classList.toggle('hidden');
                themeToggleDarkIconFooter.classList.toggle('hidden');
                themeToggleLightIconFooter.classList.toggle('hidden');

                // If set via local storage previously
                if (localStorage.getItem('color-theme')) {
                    if (localStorage.getItem('color-theme') === 'light') {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    }
                } else {
                    // If NOT set via local storage previously
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    }
                }
            };

            themeToggle.addEventListener('click', toggleTheme);
            themeToggleFooter.addEventListener('click', toggleTheme);

            // Back to top button
            const backToTopButton = document.getElementById('back-to-top');
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 300) {
                    backToTopButton.classList.remove('translate-y-20');
                    backToTopButton.classList.remove('opacity-0');
                    backToTopButton.classList.add('translate-y-0');
                    backToTopButton.classList.add('opacity-100');
                } else {
                    backToTopButton.classList.add('translate-y-20');
                    backToTopButton.classList.add('opacity-0');
                    backToTopButton.classList.remove('translate-y-0');
                    backToTopButton.classList.remove('opacity-100');
                }
            });

            backToTopButton.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Animate elements on scroll
            const animateOnScroll = () => {
                const elements = document.querySelectorAll('.animate__animated');
                
                elements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    const screenPosition = window.innerHeight / 1.3;
                    
                    if (elementPosition < screenPosition) {
                        const animationClass = element.classList[1];
                        element.classList.add('animate__animated', animationClass);
                    }
                });
            };

            window.addEventListener('scroll', animateOnScroll);
            document.addEventListener('DOMContentLoaded', animateOnScroll);

            // Counter animation for stats
            function animateValue(id, start, end, duration) {
                const obj = document.getElementById(id);
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    obj.innerHTML = Math.floor(progress * (end - start) + start);
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            }

            // Initialize counters when stats section is in view
            const statsSection = document.querySelector('section.bg-gradient-to-r');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateValue('bikes-count', 0, 250, 2000);
                        animateValue('happy-riders', 0, 10000, 2000);
                        animateValue('cities-covered', 0, 50, 2000);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            observer.observe(statsSection);

            // Particles.js initialization
            particlesJS('particles-js', {
                "particles": {
                    "number": {
                        "value": 80,
                        "density": {
                            "enable": true,
                            "value_area": 800
                        }
                    },
                    "color": {
                        "value": "#3b82f6"
                    },
                    "shape": {
                        "type": "circle",
                        "stroke": {
                            "width": 0,
                            "color": "#000000"
                        },
                        "polygon": {
                            "nb_sides": 5
                        }
                    },
                    "opacity": {
                        "value": 0.3,
                        "random": false,
                        "anim": {
                            "enable": false,
                            "speed": 1,
                            "opacity_min": 0.1,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 3,
                        "random": true,
                        "anim": {
                            "enable": false,
                            "speed": 40,
                            "size_min": 0.1,
                            "sync": false
                        }
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 150,
                        "color": "#3b82f6",
                        "opacity": 0.2,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 2,
                        "direction": "none",
                        "random": false,
                        "straight": false,
                        "out_mode": "out",
                        "bounce": false,
                        "attract": {
                            "enable": false,
                            "rotateX": 600,
                            "rotateY": 1200
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": true,
                            "mode": "grab"
                        },
                        "onclick": {
                            "enable": true,
                            "mode": "push"
                        },
                        "resize": true
                    },
                    "modes": {
                        "grab": {
                            "distance": 140,
                            "line_linked": {
                                "opacity": 1
                            }
                        },
                        "bubble": {
                            "distance": 400,
                            "size": 40,
                            "duration": 2,
                            "opacity": 8,
                            "speed": 3
                        },
                        "repulse": {
                            "distance": 200,
                            "duration": 0.4
                        },
                        "push": {
                            "particles_nb": 4
                        },
                        "remove": {
                            "particles_nb": 2
                        }
                    }
                },
                "retina_detect": true
            });
        </script>
    </body>
</html>