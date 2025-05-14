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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const clientTab = document.getElementById('client-tab');
            const partnerTab = document.getElementById('partner-tab');
            const clientContent = document.getElementById('client-content');
            const partnerContent = document.getElementById('partner-content');

            // Switch to Partner Tab
            partnerTab.addEventListener('click', function() {
                // Update tabs
                clientTab.classList.remove('bg-indigo-600', 'text-white');
                clientTab.classList.add('text-gray-700', 'hover:text-gray-900');
                partnerTab.classList.add('bg-indigo-600', 'text-white');
                partnerTab.classList.remove('text-gray-700', 'hover:text-gray-900');
                
                // Update content
                clientContent.classList.add('hidden', 'opacity-0', 'translate-y-4');
                clientContent.classList.remove('opacity-100', 'translate-y-0');
                
                setTimeout(() => {
                    partnerContent.classList.remove('hidden');
                    setTimeout(() => {
                        partnerContent.classList.remove('opacity-0', 'translate-y-4');
                        partnerContent.classList.add('opacity-100', 'translate-y-0');
                    }, 20);
                }, 300);
            });

            // Switch to Client Tab
            clientTab.addEventListener('click', function() {
                // Update tabs
                partnerTab.classList.remove('bg-indigo-600', 'text-white');
                partnerTab.classList.add('text-gray-700', 'hover:text-gray-900');
                clientTab.classList.add('bg-indigo-600', 'text-white');
                clientTab.classList.remove('text-gray-700', 'hover:text-gray-900');
                
                // Update content
                partnerContent.classList.add('hidden', 'opacity-0', 'translate-y-4');
                partnerContent.classList.remove('opacity-100', 'translate-y-0');
                
                setTimeout(() => {
                    clientContent.classList.remove('hidden');
                    setTimeout(() => {
                        clientContent.classList.remove('opacity-0', 'translate-y-4');
                        clientContent.classList.add('opacity-100', 'translate-y-0');
                    }, 20);
                }, 300);
            });
        });
    </script>
</x-guest-layout>