<aside id="sidebar"
    class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 {{ 'hidden' }} w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width"
    aria-label="Sidebar">
    <div
        class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                <ul class="pb-2 space-y-2">
                    <li>
                        <form action="#" method="GET" class="lg:hidden">
                            <label for="mobile-search" class="sr-only">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" name="email" id="mobile-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-200 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Search">
                            </div>
                        </form>
                    </li>

                    <x-admin.sidebar-menu-item :href="route('admin.profile')" :active="request()->routeIs('admin.profile')">

                        <x-slot name="icon">
                            <x-ri-user-3-line />
                        </x-slot>
                        <x-slot name="title">
                            {{ __('Profile') }}
                        </x-slot>


                    </x-admin.sidebar-menu-item>

                    <x-admin.sidebar-menu-item :active="request()->routeIs('admin.movies*')" :dropdown="true">

                        <x-slot name="icon">
                            <x-ri-article-line />
                        </x-slot>
                        <x-slot name="title">
                            {{ __('Movies') }}
                        </x-slot>

                        <x-slot name="submenu">
                            <x-admin.sidebar-sub-menu-item :href="route('admin.movies')" :active="request()->routeIs('admin.movies')">
                                View all Movies
                            </x-admin.sidebar-sub-menu-item>
                            <x-admin.sidebar-sub-menu-item :href="route('admin.movies.create')" :active="request()->routeIs('admin.movies.create')">
                                Add new Movie
                            </x-admin.sidebar-sub-menu-item>
                            {{-- <x-admin.sidebar-sub-menu-item :href="route('admin.movies.genres')" :active="request()->routeIs('admin.posts.categories')">
                                Genres
                            </x-admin.sidebar-sub-menu-item> --}}
                        </x-slot>

                    </x-admin.sidebar-menu-item>
                    <x-admin.sidebar-menu-item :active="request()->routeIs('admin.shows*')" :dropdown="true">

                        <x-slot name="icon">
                            <x-ri-movie-2-line />
                        </x-slot>
                        <x-slot name="title">
                            {{ __('Shows') }}
                        </x-slot>

                        <x-slot name="submenu">
                            <x-admin.sidebar-sub-menu-item :href="route('admin.shows')" :active="request()->routeIs('admin.shows')">
                                View all Shows
                            </x-admin.sidebar-sub-menu-item>
                            <x-admin.sidebar-sub-menu-item :href="route('admin.shows.upcoming')" :active="request()->routeIs('admin.shows.upcoming')">
                                Upcoming Shows
                            </x-admin.sidebar-sub-menu-item>
                            <x-admin.sidebar-sub-menu-item :href="route('admin.shows.create.guide')" :active="request()->routeIs('admin.shows.create.guide')">
                                Create Shows
                            </x-admin.sidebar-sub-menu-item>

                        </x-slot>

                    </x-admin.sidebar-menu-item>
                    <x-admin.sidebar-menu-item :active="request()->routeIs('admin.foods*')" :dropdown="true">

                        <x-slot name="icon">
                            <x-ri-folder-add-fill />
                        </x-slot>
                        <x-slot name="title">
                            {{ __('Foods') }}
                        </x-slot>

                        <x-slot name="submenu">
                            <x-admin.sidebar-sub-menu-item :href="route('admin.foods.index')" :active="request()->routeIs('admin.foods.index')">
                                View all Foods
                            </x-admin.sidebar-sub-menu-item>

                            <x-admin.sidebar-sub-menu-item :href="route('admin.foods.create')" :active="request()->routeIs('admin.foods.create')">
                                Create Foods
                            </x-admin.sidebar-sub-menu-item>

                        </x-slot>

                    </x-admin.sidebar-menu-item>




                </ul>

            </div>
        </div>

    </div>
</aside>
<div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>
