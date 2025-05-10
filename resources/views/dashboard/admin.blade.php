<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-semibold mb-6">Admin Dashboard</h1>

                    <div class="mb-8">
                        <h2 class="text-lg font-medium mb-4">Welcome back, {{ $user->name }}!</h2>
                        <p class="text-gray-600">From here you can manage the entire Vélocité platform, including users, bikes, rentals, and system settings.</p>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                            <h3 class="text-sm font-medium text-blue-800 mb-2">Total Users</h3>
                            <p class="text-3xl font-bold text-blue-600">{{ $totalUsers }}</p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                            <h3 class="text-sm font-medium text-green-800 mb-2">Total Bikes</h3>
                            <p class="text-3xl font-bold text-green-600">{{ $totalBikes }}</p>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-100">
                            <h3 class="text-sm font-medium text-yellow-800 mb-2">Total Rentals</h3>
                            <p class="text-3xl font-bold text-yellow-600">{{ $totalRentals }}</p>
                        </div>
                        <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100">
                            <h3 class="text-sm font-medium text-indigo-800 mb-2">Bike Categories</h3>
                            <p class="text-3xl font-bold text-indigo-600">{{ $totalCategories }}</p>
                        </div>
                    </div>

                    <!-- Users By Role -->
                    <div class="mb-8">
                        <h2 class="text-lg font-medium mb-4">Users by Role</h2>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <div class="bg-white p-4 rounded-lg border border-gray-200">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-600 mb-1">Clients</h3>
                                        <p class="text-2xl font-bold text-blue-600">{{ $usersByRole['client'] }}</p>
                                    </div>
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white p-4 rounded-lg border border-gray-200">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-600 mb-1">Partners</h3>
                                        <p class="text-2xl font-bold text-green-600">{{ $usersByRole['partner'] }}</p>
                                    </div>
                                    <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white p-4 rounded-lg border border-gray-200">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-600 mb-1">Agents</h3>
                                        <p class="text-2xl font-bold text-yellow-600">{{ $usersByRole['agent'] }}</p>
                                    </div>
                                    <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white p-4 rounded-lg border border-gray-200">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-600 mb-1">Admins</h3>
                                        <p class="text-2xl font-bold text-red-600">{{ $usersByRole['admin'] }}</p>
                                    </div>
                                    <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Users -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-medium">Recent Users</h2>
                            <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All Users</a>
                        </div>

                        @if($recentUsers->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white rounded-lg overflow-hidden">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($recentUsers as $recentUser)
                                            <tr>
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="h-10 w-10 rounded-full bg-blue-200 flex items-center justify-center text-blue-600 font-bold">
                                                            {{ substr($recentUser->name, 0, 1) }}
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">{{ $recentUser->name }}</div>
                                                            <div class="text-sm text-gray-500">{{ $recentUser->email }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    @php
                                                        $roleColor = [
                                                            'client' => 'bg-blue-100 text-blue-800',
                                                            'partner' => 'bg-green-100 text-green-800',
                                                            'agent' => 'bg-purple-100 text-purple-800',
                                                            'admin' => 'bg-red-100 text-red-800',
                                                        ][$recentUser->role] ?? 'bg-gray-100 text-gray-800';
                                                    @endphp
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $roleColor }}">
                                                        {{ ucfirst($recentUser->role) }}
                                                    </span>
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $recentUser->profile->city ?? 'N/A' }}</div>
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $recentUser->created_at->format('M d, Y') }}</div>
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                                    <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                                    <a href="#" class="text-green-600 hover:text-green-900 mr-3">Edit</a>
                                                    <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="bg-gray-50 rounded-lg p-4 text-center">
                                <p class="text-gray-600">No recent users found.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Admin Actions -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium mb-3">User Management</h3>
                            <p class="text-gray-600 mb-4">Create, edit and manage users across all roles.</p>
                            <div class="space-y-2">
                                <a href="#" class="block w-full text-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Create New User
                                </a>
                                <a href="#" class="block w-full text-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Manage Users
                                </a>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium mb-3">Bike Management</h3>
                            <p class="text-gray-600 mb-4">Manage bike listings, categories, and rental settings.</p>
                            <div class="space-y-2">
                                <a href="#" class="block w-full text-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    Manage Categories
                                </a>
                                <a href="#" class="block w-full text-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Manage Bikes
                                </a>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium mb-3">System Settings</h3>
                            <p class="text-gray-600 mb-4">Configure application settings and maintenance tasks.</p>
                            <div class="space-y-2">
                                <a href="#" class="block w-full text-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                                    System Settings
                                </a>
                                <a href="#" class="block w-full text-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Maintenance Tasks
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
