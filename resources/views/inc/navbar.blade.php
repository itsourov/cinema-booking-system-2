<nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 shadow dark:bg-gray-800">
    <div class="container flex flex-wrap items-center justify-between mx-auto">
        <a href="/" class="flex items-center">
            <img src="{{ asset('/images/logo.png') }}" class="h-8 mr-3" alt=" Logo" />
            {{-- @if ($siteSettings->showLogoText)
                <span
                    class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{ $siteSettings->site_title }}</span>
            @endif --}}
        </a>
        <div class="flex items-center md:order-2">
            <button id="theme-toggle" data-tooltip-target="tooltip-toggle" type="button"
                class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none   mr-2 rounded-lg text-sm p-2">

                <x-ri-moon-clear-line id="theme-toggle-dark-icon" class="hidden" />
                <x-ri-sun-line id="theme-toggle-light-icon" class="hidden" />
            </button>
            <div id="tooltip-toggle" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                Toggle dark mode
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">


                    <button type="button"
                        class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none   rounded-lg text-sm p-2">
                        <span class="sr-only">Open user menu</span>
                        @auth
                            <img class="w-6 h-6 rounded-full border  border-primary-400"
                                src="{{ auth()->user()->getMedia('profileImages')->last()? auth()->user()->getMedia('profileImages')->last()->getUrl('small'): asset('images/user.png') }}"
                                alt="">
                        @else
                            <img class="w-6 h-6 rounded-full border  border-primary-400"
                                src="{{ asset('/images/user.png') }}" alt="">
                        @endauth

                    </button>

                </x-slot>

                <x-slot name="content">
                    @auth


                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        @if (auth()->user()->role == 'admin')
                            <x-dropdown-link :href="route('admin')">
                                {{ __('Admin Panel') }}
                            </x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    @else
                        <x-dropdown-link :href="route('login')">
                            {{ __('Login') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('register')">
                            {{ __('Register') }}
                        </x-dropdown-link>
                    @endauth
                </x-slot>
            </x-dropdown>
            <!-- Dropdown menu -->

            <button data-collapse-toggle="mobile-menu-2" type="button"
                class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="mobile-menu-2" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <x-ri-menu-fill />
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="mobile-menu-2">

            <ul
                class="flex flex-col py-2 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-2 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-800 dark:border-gray-700">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{ __('Home') }}
                </x-nav-link>
                <x-nav-link :href="route('movies.index')" :active="request()->routeIs('movies.index')">
                    {{ __('Movies') }}
                </x-nav-link>
                <x-nav-link :href="route('shows.index')" :active="request()->routeIs('shows.index')">
                    {{ __('Upcoming Show') }}
                </x-nav-link>
                <x-nav-link :href="route('ticket.index')" :active="request()->routeIs('ticket.index')">
                    {{ __('My Tickets') }}
                </x-nav-link>
                <x-nav-link :href="route('food.index')" :active="request()->routeIs('food.index')">
                    {{ __('Food corner') }}
                </x-nav-link>
                <x-nav-link :href="route('food-order.index')" :active="request()->routeIs('food-order.index')">
                    {{ __('My Foods') }}
                </x-nav-link>



            </ul>
        </div>
    </div>
</nav>
