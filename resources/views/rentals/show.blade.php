<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Rental Details</h1>
                <p class="text-sm text-gray-600">Rental #{{ $rental->id }}</p>
            </div>
            <a href="{{ route('rentals.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Rentals
            </a>
        </div>

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
                                <dt class="text-sm font-medium text-gray-500">Location</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $rental->bike->location }}</dd>
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
                                <dt class="text-sm font-medium text-gray-500">Bike Owner</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $rental->bike->owner->name }}</dd>
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
                    <form action="{{ route('rentals.cancel', $rental->id) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Are you sure you want to cancel this rental?')">
                            Cancel Rental Request
                        </button>
                    </form>
                @elseif($rental->status === 'confirmed')
                    <div class="text-sm text-gray-600">
                        Your rental has been confirmed. Please pick up the bike at the designated location on {{ $rental->start_date->format('M d, Y') }}.
                    </div>
                @elseif($rental->status === 'ongoing')
                    <div class="text-sm text-gray-600">
                        Your rental is currently ongoing. Please return the bike at the designated location by {{ $rental->end_date->format('M d, Y') }}.
                    </div>
                @elseif($rental->status === 'completed' && !$rental->bikeRating()->exists())
                    <div id="rate" class="border-t border-gray-200 pt-4 mt-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Rate Your Experience</h3>
                        <form action="{{ route('rentals.rate', $rental->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Rating (1-5 stars)</label>
                                <div class="flex items-center">
                                    <div class="flex items-center space-x-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <label class="cursor-pointer">
                                                <input type="radio" name="rating" value="{{ $i }}" class="sr-only" {{ old('rating') == $i ? 'checked' : '' }}>
                                                <svg class="w-8 h-8 text-gray-300 rating-star hover:text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" data-value="{{ $i }}">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            </label>
                                        @endfor
                                    </div>
                                </div>
                                @error('rating')
                                    <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="review" class="block text-sm font-medium text-gray-700 mb-1">Review (optional)</label>
                                <textarea name="review" id="review" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('review') }}</textarea>
                                @error('review')
                                    <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Submit Rating
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if($rental->status === 'completed' && !$rental->bikeRating()->exists())
        @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const stars = document.querySelectorAll('.rating-star');
                const ratingInputs = document.querySelectorAll('input[name="rating"]');

                stars.forEach(star => {
                    star.addEventListener('mouseover', function() {
                        const value = this.dataset.value;

                        stars.forEach(s => {
                            if (s.dataset.value <= value) {
                                s.classList.add('text-yellow-400');
                                s.classList.remove('text-gray-300');
                            } else {
                                s.classList.add('text-gray-300');
                                s.classList.remove('text-yellow-400');
                            }
                        });
                    });

                    star.addEventListener('mouseout', function() {
                        const checkedInput = document.querySelector('input[name="rating"]:checked');
                        const checkedValue = checkedInput ? checkedInput.value : 0;

                        stars.forEach(s => {
                            if (s.dataset.value <= checkedValue) {
                                s.classList.add('text-yellow-400');
                                s.classList.remove('text-gray-300');
                            } else {
                                s.classList.add('text-gray-300');
                                s.classList.remove('text-yellow-400');
                            }
                        });
                    });

                    star.addEventListener('click', function() {
                        const value = this.dataset.value;
                        ratingInputs.forEach(input => {
                            if (input.value === value) {
                                input.checked = true;
                            }
                        });

                        stars.forEach(s => {
                            if (s.dataset.value <= value) {
                                s.classList.add('text-yellow-400');
                                s.classList.remove('text-gray-300');
                            } else {
                                s.classList.add('text-gray-300');
                                s.classList.remove('text-yellow-400');
                            }
                        });
                    });
                });

                // Set initial state if there's a previously selected rating
                const checkedInput = document.querySelector('input[name="rating"]:checked');
                if (checkedInput) {
                    const checkedValue = checkedInput.value;
                    stars.forEach(s => {
                        if (s.dataset.value <= checkedValue) {
                            s.classList.add('text-yellow-400');
                            s.classList.remove('text-gray-300');
                        }
                    });
                }
            });
        </script>
        @endpush
    @endif
</x-app-layout>
