<x-app-layout>
    <title>{{ $movie->title }}</title>
    <div class="container mx-auto px-2 mt-5">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <div class="flex justify-center ">
                <a href="{{ $movie->poster('original') }}" class="spotlight">
                    <img src="{{ $movie->poster('w500') }}" alt="" class=" rounded shadow w-full max-w-sm">
                </a>

            </div>
            <div class="md:col-span-2 lg:col-span-2 space-y-3">
                <p class=" text-xl text-yellow-400 font-bold">{{ date('M. d, Y', strtotime($movie->release_date)) }}</p>
                <h2 class=" text-3xl font-bold" style="font-family: 'Lora', serif;">{{ $movie->title }}</h2>
                <div class="flex items-center gap-3">
                    <div class="bg-gray-100 dark:bg-gray-800 text-sm  p-1 rounded">
                        {{ $movie->certification }}
                    </div>
                    <p class="text-sm text-gray-500">{{ date('M. d, Y', strtotime($movie->release_date)) }}</p>

                    <div class="flex divide-x dark:divide-gray-500">
                        @foreach ($movie->genres as $genre)
                            <a href="/" class="hover:text-primary-600 px-2">{{ $genre->title }}</a>
                        @endforeach
                    </div>

                </div>
                <p><span class=" text-orange-400">Runtime:</span> {{ $movie->runtime }} min</p>
                <p class="text-orange-500 border p-2 rounded">Upcoming Show count : {{ $movie->shows_count }}</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 ">
                    @foreach ($movie->shows as $show)
                        <div class="border rounded bg-gray-100 dark:bg-gray-800 ">
                            <a href="{{ route('shows.show', $show->id) }}" class="block p-4">
                                {{ date('d M, Y h:i A', strtotime($show->date)) . ' (GMT)' }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>


        </div>
        <div class="mt-5 border-t border-b dark:border-gray-700 py-2">
            <div class="grid grid-cols-2 gap-1 md:block md:space-y-1">
                <button class="rounded bg-gray-100 dark:bg-gray-700 px-4 py-1.5 transition-all duration-200 tab-btn"
                    data-target="info-container">Info</button>
                <button class="rounded bg-gray-100 dark:bg-gray-700 px-4 py-1.5 transition-all duration-200 tab-btn"
                    data-target="casts-container">Casts</button>
                <button class="rounded bg-gray-100 dark:bg-gray-700 px-4 py-1.5 transition-all duration-200 tab-btn"
                    data-target="trailer-container">Trailer</button>
                <button class="rounded bg-gray-100 dark:bg-gray-700 px-4 py-1.5 transition-all duration-200 tab-btn"
                    data-target="shows-container">Shows</button>

            </div>

        </div>

        <div class="mt-3 space-y-4 ">
            <div id="info-container" class="tab-content">
                <h4 class="text-base font-bold">Synopsis</h4>
                <p>{{ $movie->synopsis }}</p>

                <hr class="h-px my-5 bg-gray-200 border-0 dark:bg-gray-700">

                <div class="mt-2 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4">

                    @foreach ($movie->images as $index => $image)
                        <a href="https://image.tmdb.org/t/p/original{{ $image['file_path'] }}"
                            class="spotlight singel-image"
                            @if ($index > 7) style="display:none" @endif>
                            <img src="https://image.tmdb.org/t/p/w500{{ $image['file_path'] }}" alt=""
                                class=" rounded shadow ">
                        </a>
                    @endforeach
                </div>
                <div class="flex justify-end">
                    <button class="hover:text-primary-500" id="viewAllImageButton">View
                        all</button>
                </div>
            </div>
            <div id="casts-container" class="tab-content" style="display:none;">
                <h4 class="text-base font-bold">Director</h4>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2  mt-2">
                    @foreach ($movie->crew as $crew)
                        @if ($crew['job'] == 'Director')
                            <div
                                class="border dark:border-gray-800 dark:shadow dark:shadow-gray-800 dark:bg-gray-900 rounded p-2  flex flex-wrap md:flex-nowrap md:space-x-2">

                                <img src="{{ $crew['profile_path'] ? 'https://image.tmdb.org/t/p/w500' . $crew['profile_path'] : 'https://movies.itsourov.com/wp-content/themes/dooplay/assets/img/no/cast.png' }}"
                                    alt="" class=" object-cover w-full md:w-1/3 rounded shadow">
                                <div class="">
                                    <p class="text-md font-bold">{{ $crew['name'] }}</p>
                                    <p class=" font-light text-sm">{{ $crew['job'] }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="flex justify-between">
                    <h4 class="text-base font-bold mt-5">Casts</h4>
                    <button class="hover:text-primary-500" id="viewAllCasttButton">View
                        all</button>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2  mt-2">
                    @foreach ($movie->cast as $index => $cast)
                        <div class="border dark:border-gray-800 dark:shadow dark:shadow-gray-800 dark:bg-gray-900 rounded p-2  flex flex-wrap md:flex-nowrap md:space-x-2 singel-cast"
                            @if ($index > 9) style="display:none" @endif>

                            <img src="{{ $cast['profile_path'] ? 'https://image.tmdb.org/t/p/w500' . $cast['profile_path'] : 'https://movies.itsourov.com/wp-content/themes/dooplay/assets/img/no/cast.png' }}"
                                alt="" class=" object-cover w-full md:w-1/3 rounded shadow">
                            <div class="">
                                <p class="text-md font-bold">{{ $cast['name'] }}</p>
                                <p class=" font-light text-sm">{{ $cast['character'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="trailer-container" class="tab-content" style="display:none;">
                <h4 class="text-base font-bold">Videos</h4>

                @if (count($movie->trailers))
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                        <div class=" md:col-span-2">
                            <div class="video-container">


                                <iframe id="trailerVideoPreview"
                                    src="https://www.youtube.com/embed/{{ $movie->trailers[array_key_last($movie->trailers)]['key'] ?? '' }}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="relative overflow-hidden">
                            <div
                                class="space-y-3 grid grid-cols-1 overflow-y-scroll max-h-[60vh] border dark:border-gray-800 dark:shadow  p-1">
                                @foreach ($movie->trailers as $video)
                                    <button
                                        class="border dark:border-gray-800 dark:shadow dark:shadow-gray-800 dark:bg-gray-900 rounded p-2 flex gap-4 trailers-video-btn"
                                        data-id="{{ $video['key'] }}">
                                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                            stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z">
                                            </path>
                                        </svg>
                                        <p class=" truncate"> <span class="font-bold">{{ $video['type'] }}</span> -
                                            {{ $video['name'] }}</p>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                    </div>
                @endif

            </div>
        </div>

        <div class=" mt-10 space-y-4" id="shows">
            <h4 class="text-lg font-bold ">Shows</h4>

            <div class="links pb-5">
                <h2>This Movie has {{ $movie->shows_count }} upcoming shows. You can book a physical or virtual ticket
                    for any upcoming show</h2>

            </div>
        </div>

    </div>


</x-app-layout>
