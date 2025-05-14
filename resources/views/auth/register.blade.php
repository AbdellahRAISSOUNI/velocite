<x-guest-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-8">
        <!-- Logo & Header -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                Rejoignez <span class="text-indigo-600">Vélocité</span>
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Choisissez votre type de compte pour commencer
            </p>
        </div>

        <!-- Tab Navigation -->
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-2 px-1 rounded-full shadow-sm flex border border-gray-200">
                <button id="client-tab" class="flex-1 py-2 px-4 rounded-full text-sm font-medium text-white bg-indigo-600 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-300">
                    Je veux louer
                </button>
                <button id="partner-tab" class="flex-1 py-2 px-4 rounded-full text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-300">
                    Je veux partager
                </button>
            </div>
        </div>

        <!-- Tab Content -->
        <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Client Content -->
            <div id="client-content" class="bg-white py-8 px-6 shadow rounded-lg sm:px-10 transition-all duration-500 ease-in-out">
                <div class="space-y-6">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <h3 class="mt-4 text-xl font-bold text-gray-900">Compte Client</h3>
                        <p class="mt-1 text-sm text-gray-600">Pour ceux qui veulent louer des vélos</p>
                    </div>

                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-green-500 mt-0.5 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700">Accès à des centaines de vélos disponibles</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-green-500 mt-0.5 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700">Réservation facile avec confirmation instantanée</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-green-500 mt-0.5 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700">Périodes de location flexibles</span>
                        </li>
                    </ul>

                    <div class="pt-4">
                        <a href="{{ route('register.client') }}" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-300">
                            S'inscrire comme Client
                        </a>
                    </div>
                </div>
            </div>

            <!-- Partner Content (Hidden by default) -->
            <div id="partner-content" class="bg-white py-8 px-6 shadow rounded-lg sm:px-10 transition-all duration-500 ease-in-out hidden opacity-0 translate-y-4">
                <div class="space-y-6">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <h3 class="mt-4 text-xl font-bold text-gray-900">Compte Partenaire</h3>
                        <p class="mt-1 text-sm text-gray-600">Pour ceux qui veulent partager leurs vélos</p>
                    </div>

                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-green-500 mt-0.5 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700">Listez vos vélos en quelques minutes</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-green-500 mt-0.5 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700">Fixez vos propres tarifs et disponibilités</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-green-500 mt-0.5 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700">Paiements sécurisés et assurance incluse</span>
                        </li>
                    </ul>

                    <div class="pt-4">
                        <a href="{{ route('register.partner') }}" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-300">
                            Devenir Partenaire
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Login Link -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-600">
                Vous avez déjà un compte?
                <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-150">
                    Connectez-vous ici
                </a>
            </p>
        </div>
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