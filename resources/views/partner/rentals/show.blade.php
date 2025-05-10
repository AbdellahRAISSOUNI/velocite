<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Rental Details</h1>
                <p class="text-sm text-gray-600">Rental #{{ $rental->id }}</p>
            </div>
            <a href="{{ route('partner.rentals.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Rentals
            </a>
        </div>

        <!-- Main Details Card -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                <div>
                    <h2 class="text-lg leading-6 font-medium text-gray-900">{{ $rental->bike->title }}</h2>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">{{ $rental->bike->category->name }} - {{ $rental->bike->brand }} {{ $rental->bike->model }}</p>
                </div>
                <div>
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
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColor }}">
                        {{ ucfirst($rental->status) }}
                    </span>
                </div>
            </div>

            <div class="border-t border-gray-200">
                <div class="md:flex md:divide-x">
                    <!-- Bike Image -->
                    <div class="px-4 py-5 sm:px-6 md:w-1/3">
                        <div class="h-48 bg-gray-200 rounded-md relative overflow-hidden">
                            @if($rental->bike->primaryImage)
                                <img src="{{ asset('storage/bikes/placeholder.jpg') }}" alt="{{ $rental->bike->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="text-gray-400">No image available</span>
                                </div>
                            @endif

                            @if($rental->bike->is_electric)
                                <div class="absolute top-0 right-0 bg-green-600 text-white py-1 px-3 text-xs font-semibold">
                                    Electric
                                </div>
                            @endif
                        </div>

                        <div class="mt-4">
                            <h3 class="text-sm font-medium text-gray-500">Renter Information</h3>
                            <div class="mt-2 flex items-center">
                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $rental->renter->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $rental->renter->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rental Information -->
                    <div class="px-4 py-5 sm:px-6 md:w-2/3">
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Rental Period</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $rental->start_date->format('M d, Y') }} - {{ $rental->end_date->format('M d, Y') }}
                                    <span class="text-xs text-gray-500">({{ $rental->start_date->diffInDays($rental->end_date) + 1 }} days)</span>
                                </dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Total Price</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-semibold">€{{ number_format($rental->total_price, 2) }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Security Deposit</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if($rental->security_deposit > 0)
                                        €{{ number_format($rental->security_deposit, 2) }}
                                        @if($rental->is_deposit_returned)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Returned</span>
                                        @endif
                                    @else
                                        None
                                    @endif
                                </dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Request Date</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $rental->created_at->format('M d, Y H:i') }}</dd>
                            </div>

                            @if($rental->cancelled_at)
                                <div class="md:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Cancellation Date</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $rental->cancelled_at->format('M d, Y H:i') }}</dd>
                                </div>

                                @if($rental->cancellation_reason)
                                    <div class="md:col-span-2">
                                        <dt class="text-sm font-medium text-gray-500">Cancellation Reason</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $rental->cancellation_reason }}</dd>
                                    </div>
                                @endif
                            @endif

                            @if($rental->pickup_notes)
                                <div class="md:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Pickup Notes</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $rental->pickup_notes }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-gray-50 px-4 py-4 sm:px-6 border-t border-gray-200">
                @if($rental->status === 'pending')
                    <div class="flex flex-wrap gap-2">
                        <form action="{{ route('partner.rentals.approve', $rental->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Approve Rental
                            </button>
                        </form>

                        <button type="button" onclick="document.getElementById('reject-modal').classList.remove('hidden')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Reject Rental
                        </button>
                    </div>
                @elseif($rental->status === 'confirmed')
                    <form action="{{ route('partner.rentals.start', $rental->id) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Start Rental
                        </button>
                    </form>
                    <p class="mt-2 text-sm text-gray-600">Click when the bike has been picked up by the renter.</p>
                @elseif($rental->status === 'ongoing')
                    <form action="{{ route('partner.rentals.complete', $rental->id) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Complete Rental
                        </button>
                    </form>
                    <p class="mt-2 text-sm text-gray-600">Click when the bike has been returned by the renter.</p>
                @endif
            </div>
        </div>

        <!-- Comments Section -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium text-gray-900">Communication with Renter</h3>
                <p class="mt-1 text-sm text-gray-500">Add comments or notes about this rental.</p>
            </div>

            <div class="border-t border-gray-200">
                <div class="px-4 py-5 sm:px-6">
                    <!-- Add Comment Form -->
                    <form action="{{ route('partner.rentals.comment', $rental->id) }}" method="POST" class="mb-6">
                        @csrf
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700">Add a Comment</label>
                            <div class="mt-1">
                                <textarea id="content" name="content" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required></textarea>
                            </div>
                        </div>
                        <div class="mt-2 flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Send Comment
                            </button>
                        </div>
                    </form>

                    <!-- Comments List -->
                    @if($rental->comments->count() > 0)
                        <div class="flow-root">
                            <ul role="list" class="-mb-8">
                                @foreach($rental->comments as $comment)
                                    <li>
                                        <div class="relative pb-8">
                                            @if(!$loop->last)
                                                <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                            @endif
                                            <div class="relative flex items-start space-x-3">
                                                <div class="relative">
                                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center ring-8 ring-white">
                                                        <span class="text-sm font-medium text-gray-700">
                                                            {{ substr($comment->user->name, 0, 1) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <div>
                                                        <div class="text-sm">
                                                            <span class="font-medium text-gray-900">{{ $comment->user->name }}</span>
                                                        </div>
                                                        <p class="mt-0.5 text-sm text-gray-500">
                                                            {{ $comment->created_at->format('M d, Y H:i') }}
                                                        </p>
                                                    </div>
                                                    <div class="mt-2 text-sm text-gray-700">
                                                        <p>{{ $comment->content }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="py-4 text-center text-gray-500">
                            <p>No comments yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Rejection Modal -->
        <div id="reject-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3 text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Reject Rental Request</h3>
                    <div class="mt-2 px-7 py-3">
                        <form action="{{ route('partner.rentals.reject', $rental->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="rejection_reason" class="block text-sm font-medium text-gray-700 text-left">Reason (optional)</label>
                                <textarea name="rejection_reason" id="rejection_reason" rows="3" class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                            </div>
                            <div class="flex justify-between mt-4">
                                <button type="button" onclick="document.getElementById('reject-modal').classList.add('hidden')" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md bg-white text-gray-700 hover:bg-gray-50 focus:outline-none">
                                    Cancel
                                </button>
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none">
                                    Reject Request
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
