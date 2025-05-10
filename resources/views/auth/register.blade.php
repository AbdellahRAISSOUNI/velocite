<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-900">Register for Vélocité</h1>
        <p class="mt-2 text-sm text-gray-600">Choose your account type to continue</p>
    </div>

    <div class="flex flex-col space-y-6">
        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-medium text-gray-900">Client Account</h2>
                    <p class="mt-1 text-sm text-gray-600">For riders looking to rent bikes</p>
                    <ul class="mt-2 text-sm text-gray-600 list-disc list-inside">
                        <li>Browse available bikes</li>
                        <li>Make reservations</li>
                        <li>Manage your rentals</li>
                    </ul>
                </div>
                <a href="{{ route('register.client') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Register as Client
                </a>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-medium text-gray-900">Partner Account</h2>
                    <p class="mt-1 text-sm text-gray-600">For bike owners looking to rent out their bikes</p>
                    <ul class="mt-2 text-sm text-gray-600 list-disc list-inside">
                        <li>List your bikes for rent</li>
                        <li>Manage reservations</li>
                        <li>Track your earnings</li>
                    </ul>
                </div>
                <a href="{{ route('register.partner') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Register as Partner
                </a>
            </div>
        </div>
    </div>

    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                Log in here
            </a>
        </p>
    </div>
</x-guest-layout>
