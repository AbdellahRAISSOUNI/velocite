<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Book a Bike</h1>
            </div>
            <a href="{{ route('bikes.show', $bike->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Bike
            </a>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1 px-4 py-5 sm:px-6">
                    <div class="bg-gray-50 p-4 rounded-lg mb-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $bike->title }}</h3>
                        <p class="text-sm text-gray-500 mb-4">{{ $bike->brand }} {{ $bike->model }} - {{ $bike->category->name }}</p>

                        <div class="w-full h-48 bg-gray-200 rounded-md relative overflow-hidden mb-4">
                            @if($bike->primaryImage)
                                <img src="{{ asset('storage/bikes/placeholder.jpg') }}" alt="{{ $bike->title }}" class="w-full h-full object-cover">
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

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <h4 class="text-xs font-medium text-gray-500">Daily Rate</h4>
                                <p class="text-lg font-semibold text-blue-600">€{{ number_format($bike->daily_rate, 2) }}</p>
                            </div>
                            <div>
                                <h4 class="text-xs font-medium text-gray-500">Location</h4>
                                <p class="text-sm text-gray-800">{{ $bike->location }}</p>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-xs font-medium text-gray-500">Owner</h4>
                            <p class="text-sm text-gray-800">{{ $bike->owner->name }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{ route('rentals.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="bike_id" value="{{ $bike->id }}">

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-1 gap-6">
                                <!-- Date Selection -->
                                <div class="col-span-1 sm:col-span-1">
                                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                                    <input type="date" name="start_date" id="start_date" value="{{ $startDate ? $startDate->format('Y-m-d') : '' }}" min="{{ date('Y-m-d') }}"
                                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                    @error('start_date')
                                        <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-1 sm:col-span-1">
                                    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                                    <input type="date" name="end_date" id="end_date" value="{{ $endDate ? $endDate->format('Y-m-d') : '' }}" min="{{ date('Y-m-d') }}"
                                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                    @error('end_date')
                                        <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div id="price-calculation" class="col-span-1 bg-gray-50 p-4 rounded-lg hidden">
                                    <h4 class="text-sm font-medium text-gray-700 mb-2">Price Calculation</h4>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm text-gray-600" id="days-count">0 days</span>
                                        <span class="text-sm text-gray-600" id="daily-rate">€{{ number_format($bike->daily_rate, 2) }} per day</span>
                                    </div>
                                    <div class="flex justify-between border-t border-gray-200 pt-2 mt-2">
                                        <span class="text-sm font-medium text-gray-700">Total Price</span>
                                        <span class="text-sm font-semibold text-blue-600" id="total-price">€0.00</span>
                                    </div>
                                </div>

                                <div class="col-span-1">
                                    <label for="pickup_notes" class="block text-sm font-medium text-gray-700">Pickup Notes (Optional)</label>
                                    <textarea id="pickup_notes" name="pickup_notes" rows="3" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('pickup_notes') }}</textarea>
                                    @error('pickup_notes')
                                        <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Book Now
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const priceCalculation = document.getElementById('price-calculation');
            const daysCount = document.getElementById('days-count');
            const totalPrice = document.getElementById('total-price');
            const dailyRate = {{ $bike->daily_rate }};

            function updatePriceCalculation() {
                const startDate = new Date(startDateInput.value);
                const endDate = new Date(endDateInput.value);

                if (startDateInput.value && endDateInput.value && startDate <= endDate) {
                    const timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
                    const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1; // Include both start and end day
                    const price = dailyRate * daysDiff;

                    daysCount.textContent = daysDiff + ' day' + (daysDiff !== 1 ? 's' : '');
                    totalPrice.textContent = '€' + price.toFixed(2);

                    priceCalculation.classList.remove('hidden');
                } else {
                    priceCalculation.classList.add('hidden');
                }
            }

            startDateInput.addEventListener('change', function() {
                // Set the minimum end date to be the start date
                endDateInput.min = startDateInput.value;

                // If the end date is before the start date, update it
                if (endDateInput.value && new Date(endDateInput.value) < new Date(startDateInput.value)) {
                    endDateInput.value = startDateInput.value;
                }

                updatePriceCalculation();
            });

            endDateInput.addEventListener('change', updatePriceCalculation);

            // Initial calculation on page load
            if (startDateInput.value && endDateInput.value) {
                updatePriceCalculation();
            }
        });
    </script>
    @endpush
</x-app-layout>
