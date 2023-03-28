<x-app-layout>
    <div class="container mx-auto px-2 my-10">
        @if ($genres->isEmpty())
            <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                role="alert">
                <span class="font-medium">No recomendation found! </span> Go book some ticket first then the system will
                generate some recomendation for you
            </div>
        @else
            <div class="grid gap-4">
                @foreach ($genres as $genre)
                    <x-card class="p-4">
                        <h2>{{ $genre->title }}</h2>
                        <p>You chosed these movie from this genre(@foreach ($genre->watchedItems as $item)
                                {{ $item->title }},
                            @endforeach
                            ) </p>



                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                            @foreach ($genre->movies->take(3) as $movie)
                                <x-movies.movie-card class="" :movie="$movie" :details="false" />
                            @endforeach
                        </div>
                    </x-card>
                @endforeach

            </div>

        @endif

    </div>
</x-app-layout>
