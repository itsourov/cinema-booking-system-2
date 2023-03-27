  <x-card {{ $attributes->merge(['class' => 'flex']) }}>



      <img src="{{ $movie->poster_link }}" alt="" class=" w-1/3 object-cover">
      <div class="p-2 ">
          <a href="{{ route('movies.show', $movie->id) }}">
              <h2 class="font-bold text-lg">{{ $movie->title }}</h2>
          </a>
          <p>release date: {{ $movie->release_date }}</p>
          <x-secondary-button data-trailer="{{ $movie->trailer_link }}" x-data=""
              x-on:click.prevent="openModal(event), $dispatch('open-modal', 'trailer_preview')">Preview
              Trailer</x-secondary-button>

          <div class="tags">
              @foreach ($movie->genres as $genre)
                  <a href="{{ route('movies.index', ['genre' => $genre->id]) }}"
                      class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $genre->title }}</a>
              @endforeach
          </div>
          <p class="mt-10"> Upcoming Show count: <span class=" text-red-500">{{ $movie->shows_count }}</span></p>


          @if ($details)
          @else
              <a href="{{ route('movies.show', $movie->id) }}">
                  <x-primary-button class=" mt-2">View details</x-primary-button>
              </a>
          @endif

      </div>
  </x-card>
