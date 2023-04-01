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
                            <a href="{{ route('movies.index', ['genre' => $genre->id]) }}"
                                class="hover:text-primary-600 px-2">{{ $genre->title }}</a>
                        @endforeach
                    </div>

                </div>
                <p><span class=" text-orange-400">Runtime:</span> {{ $movie->runtime }} min</p>
                <p class="text-orange-500 border p-2 rounded">Upcoming Show count : {{ $movie->shows_count }}</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 ">
                    @foreach ($movie->shows as $show)
                        <div
                            class="border dark:border-gray-700 rounded bg-gray-100 dark:bg-gray-800  flex flex-col justify-center p-1 space-y-1">

                            <p> {{ date('d M, Y h:i A', strtotime($show->date)) . ' (GMT)' }}</p>
                            <a href="{{ route('shows.show', $show->id) }}"
                                class=" bg-primary-500 p-1 rounded text-center">
                                Book a seat
                            </a>

                        </div>
                    @endforeach
                </div>

                <div class="mt-5" x-data="{ showVideoReviwUploader: false }">
                    <x-button.primary x-on:click="showVideoReviwUploader = !showVideoReviwUploader">Rate this movie
                        <x-ri-star-half-s-fill />
                    </x-button.primary>
                    @if ($userWatchedThisMovie)
                        <form action="{{ route('movies.video_reviews.create', $movie->id) }}" method="post"
                            enctype="multipart/form-data">
                            <div x-show="showVideoReviwUploader" class="mt-3" x-transition>
                                @csrf
                                <input type="file" id="reviewVideoInput" accept="video/*" name="reviewVideo">
                                <x-button.primary>Save </x-button.primary>
                            </div>
                            <x-input.error :messages="$errors->get('reviewVideo')" />
                        </form>
                        <script>
                            window.onload = function(e) {


                                // Get a reference to the file input element
                                const inputElement = document.querySelector('input[id="reviewVideoInput"]');
                                // Create a FilePond instance
                                const pond = FilePond.create(inputElement, {
                                    // Only accept images
                                    acceptedFileTypes: ['video/mp4'],
                                    storeAsFile: true,

                                });

                            }
                        </script>
                    @else
                        <div x-show="showVideoReviwUploader">
                            <h2>You haven't watched this movie or booked ticket for this movie</h2>
                        </div>
                    @endif


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
                    data-target="reviews-container">Reviews</button>

            </div>

        </div>

        <div class="mt-3 space-y-4 ">


            @include('movies.inc.show.info')
            @include('movies.inc.show.casts')
            @include('movies.inc.show.trailer')
            @include('movies.inc.show.reviews')


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
