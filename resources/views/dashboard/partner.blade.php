<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-semibold mb-6">Partner Dashboard</h1>

                    <div class="mb-8">
                        <h2 class="text-lg font-medium mb-4">Welcome back, {{ Auth::user()->name }}!</h2>
                        <p class="text-gray-600">From here you can manage your bikes, view rental requests, and check your earnings.</p>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                            <h3 class="text-sm font-medium text-blue-800 mb-2">Total Bikes</h3>
                            <p class="text-3xl font-bold text-blue-600">{{ $totalBikes }}</p>
                            <a href="{{ route('partner.bikes.index') }}" class="inline-block mt-2 text-sm text-blue-600 hover:text-blue-800">View All →</a>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-100">
                            <h3 class="text-sm font-medium text-yellow-800 mb-2">Pending Rentals</h3>
                            <p class="text-3xl font-bold text-yellow-600">{{ $pendingRentals }}</p>
                            <a href="{{ route('partner.rentals.index', ['status' => 'pending']) }}" class="inline-block mt-2 text-sm text-yellow-600 hover:text-yellow-800">View All →</a>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                            <h3 class="text-sm font-medium text-green-800 mb-2">Active Rentals</h3>
                            <p class="text-3xl font-bold text-green-600">{{ $activeRentals }}</p>
                            <a href="{{ route('partner.rentals.index', ['status' => 'ongoing']) }}" class="inline-block mt-2 text-sm text-green-600 hover:text-green-800">View All →</a>
                        </div>
                        <div class="bg-purple-50 p-4 rounded-lg border border-purple-100">
                            <h3 class="text-sm font-medium text-purple-800 mb-2">Monthly Earnings</h3>
                            <p class="text-3xl font-bold text-purple-600">
                                €{{ number_format($monthlyEarnings, 2) }}
                            </p>
                        </div>
                    </div>

                    <!-- Recent Rental Requests -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-medium">Recent Rental Requests</h2>
                            <a href="{{ route('partner.rentals.index') }}" class="text-sm text-blue-600 hover:text-blue-800">View All</a>
                        </div>

                        @if($recentRentals->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white rounded-lg overflow-hidden">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bike</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Renter</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dates</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($recentRentals as $rental)
                                            <tr>
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="h-10 w-10 flex-shrink-0 bg-gray-200 rounded-md overflow-hidden">
                                                            @if($rental->bike->primaryImage)
                                                                <img src="{{ asset('storage/' . $rental->bike->primaryImage->image_path) }}" alt="{{ $rental->bike->title }}" class="h-full w-full object-cover">
                                                            @else
                                                                <div class="w-full h-full flex items-center justify-center">
                                                                    <span class="text-gray-400">No image</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">{{ $rental->bike->title }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $rental->renter->name }}</div>
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $rental->start_date->format('M d, Y') }}</div>
                                                    <div class="text-xs text-gray-500">to {{ $rental->end_date->format('M d, Y') }}</div>
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    @php
                                                        $statusColors = [
                                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                                            'confirmed' => 'bg-blue-100 text-blue-800',
                                                            'ongoing' => 'bg-green-100 text-green-800',
                                                            'completed' => 'bg-gray-100 text-gray-800',
                                                            'cancelled' => 'bg-red-100 text-red-800',
                                                            'rejected' => 'bg-red-100 text-red-800',
                                                        ];
                                                        $statusColor = $statusColors[$rental->status] ?? 'bg-gray-100 text-gray-800';
                                                    @endphp
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }}">
                                                        {{ ucfirst($rental->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    €{{ number_format($rental->total_price, 2) }}
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('partner.rentals.show', $rental->id) }}" class="text-blue-600 hover:text-blue-900">View</a>

                                                    @if($rental->status === 'pending')
                                                        <span class="mx-1 text-gray-300">|</span>
                                                        <a href="{{ route('partner.rentals.show', $rental->id) }}" class="text-indigo-600 hover:text-indigo-900">Respond</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="bg-gray-50 rounded-lg p-4 text-center">
                                <p class="text-gray-600">You haven't received any rental requests yet.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Your Bikes -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-medium">Your Bikes</h2>
                            <a href="{{ route('partner.bikes.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Add New Bike
                            </a>
                        </div>

                        @if($recentBikes->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($recentBikes as $bike)
                                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                                        <div class="h-40 bg-gray-200 relative">
                                            @if($bike->primaryImage)
                                                <img src="{{ asset('storage/' . $bike->primaryImage->image_path) }}"
                                                    alt="{{ $bike->title }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <span class="text-gray-400">No image available</span>
                                                </div>
                                            @endif

                                            @if(!$bike->is_available)
                                                <div class="absolute top-0 right-0 bg-red-600 text-white py-1 px-3 text-xs font-semibold">
                                                    Not Available
                                                </div>
                                            @endif
                                        </div>
                                        <div class="p-4">
                                            <div class="flex justify-between items-start">
                                                <h3 class="text-base font-semibold text-gray-900">{{ $bike->title }}</h3>
                                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">{{ $bike->category->name }}</span>
                                            </div>
                                            <div class="flex items-center mt-2">
                                                <span class="text-yellow-400 mr-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                </span>
                                                <span class="text-xs text-gray-600">{{ number_format($bike->average_rating, 1) }} ({{ $bike->rating_count }})</span>
                                                <span class="mx-2 text-gray-300">|</span>
                                                <span class="text-xs text-gray-600">{{ $bike->location }}</span>
                                            </div>
                                            <div class="mt-3">
                                                <div class="text-blue-600 font-semibold">€{{ number_format($bike->daily_rate, 2) }} <span class="text-xs text-gray-500">/ day</span></div>
                                            </div>
                                            <div class="mt-4 flex justify-between">
                                                <a href="{{ route('bikes.show', $bike->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View</a>
                                                <a href="{{ route('partner.bikes.edit', $bike->id) }}" class="text-green-600 hover:text-green-800 text-sm font-medium">Edit</a>
                                                <a href="{{ route('partner.bikes.availability', $bike->id) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Availability</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-gray-50 rounded-lg p-6 text-center">
                                <p class="text-gray-600 mb-4">You haven't listed any bikes yet.</p>
                                <a href="{{ route('partner.bikes.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Add Your First Bike
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Quick Links -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium mb-3">Manage Your Profile</h3>
                            <p class="text-gray-600 mb-4">Update your personal information and manage your account settings.</p>
                            <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Edit Profile
                            </a>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium mb-3">Rental Management</h3>
                            <p class="text-gray-600 mb-4">View and manage requests to rent your bikes.</p>
                            <a href="{{ route('partner.rentals.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                View Rentals
                            </a>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium mb-3">Bike Management</h3>
                            <p class="text-gray-600 mb-4">Add new bikes or manage your existing listings.</p>
                            <a href="{{ route('partner.bikes.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Manage Bikes
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
