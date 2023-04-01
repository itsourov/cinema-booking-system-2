<x-app-layout>
    <div class="container mx-auto px-2 mt-5 space-y-4">
        @if ($movies->isEmpty())
            <x-seed-button />
        @endif

        @if (request('genre'))
            <div class="bg-primary-500 rounded bg-opacity-50 p-2 text-center">
                Genre based results
            </div>
        @else
            <h2 class=" text-base font-bold">Latest movies</h2>
        @endif


        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-2 gap-y-6">
            @foreach ($movies as $movie)
                <a href="{{ route('movies.show', $movie->id) }}">


                    <div
                        class="border dark:border-gray-800 dark:shadow dark:shadow-gray-800 dark:bg-gray-900 rounded-md overflow-clip group">
                        <div class="poster overflow-clip relative">
                            <img src="{{ $movie->poster('w500') }}" alt=""
                                class="object-cover w-full  group-hover:scale-110 transition duration-300 ease-in-out">
                            <div
                                class=" absolute top-0 right-0 flex items-center bg-black rounded bg-opacity-50 px-1 space-x-1">
                                <svg aria-hidden="true" class="w-4 h-4 text-yellow-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <span class="text-white  text-sm">
                                    {{ $movie->rating }}
                                </span>

                            </div>

                        </div>
                        <div class="p-2">
                            <p class="truncate text-black dark:text-white">{{ $movie->title }}</p>
                            <p class="text-sm text-gray-500">{{ date('M. d, Y', strtotime($movie->release_date)) }}</p>
                            <p class="text-orange-500">Upcoming Show count : {{ $movie->shows_count }}</p>
                        </div>

                    </div>
                </a>
            @endforeach
        </div>
        <div class="">
            {{ $movies->appends(Request::all())->onEachSide(1)->links('pagination.tailwind') }}
        </div>

    </div>



</x-app-layout>
