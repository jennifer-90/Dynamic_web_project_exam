<nav class="bg-white border-b border-gray-100">


    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">
            <div class="flex items-center">

                <!-- Liens de navigation (visible sur les grands écrans) -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    @if (Route::has('login'))
                        <!-- vérifie si une route nommée 'login' existe -->
                        @auth

                            <!-- ****** Lien vers la page de dashboard -->
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Tableau de bord') }}
                            </x-nav-link>

                            <!-- ****** Lien vers la page de profil -->
                            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                                {{ __('Mon profil') }}
                            </x-nav-link>

                        @else

                            <!-- ****** Lien vers la page d'accueil -->
                            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                                {{ __('Home') }}
                            </x-nav-link>

                            <!-- ****** Lien vers la page login -->
                            <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                                {{ __('Login') }}
                            </x-nav-link>

                            <!-- ****** Lien vers la page register -->
                            <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                                {{ __('Register') }}
                            </x-nav-link>

                        @endauth
                    @endif

                </div>
            </div>

            <!-- SECTION MENU DéROULANT USER CONNECTé -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Menu déroulant pour les users connectés -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <!-- Bouton déclencheur du menu déroulant avec le nom du user-->
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <!-- Contenu du menu déroulant (déconnexion, etc.) -->
                        <x-slot name="content">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>
        </div>
    </div>
</nav>
