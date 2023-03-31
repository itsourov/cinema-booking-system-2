  <x-card {{ $attributes->merge(['class' => 'flex']) }}>



      <img src="{{ $movie->poster_link }}" alt="" class=" w-1/3 object-cover">
      <div class="p-2 ">
          <h2 class="font-bold text-lg">{{ $movie->title }}</h2>
          <p>release date: {{ $movie->release_date }}</p>
          <x-secondary-button data-trailer="{{ $movie->trailer_link }}" x-data=""
              x-on:click.prevent="openModal(event), $dispatch('open-modal', 'trailer_preview')">Preview
              Trailer</x-secondary-button>
          <div class="flex gap-2 mt-2">
              <a href="{{ route('admin.movies.edit', $movie->id) }}"
                  class="bg-green-200 dark:bg-green-800 rounded px-2 py-1">
                  <x-ri-edit-2-fill />
              </a>
              <a class="bg-green-200 dark:bg-green-800 rounded px-2 py-1">
                  <x-ri-eye-fill />
              </a>
              <button class="bg-red-200 dark:bg-red-800 rounded px-2 py-1" x-data=""
                  x-on:click.prevent=" $dispatch('open-modal', 'confirm-movie-deletion{{ $movie->id }}')">
                  <x-ri-delete-bin-5-fill />
              </button>




              <x-modal name="confirm-movie-deletion{{ $movie->id }}" focusable>
                  <form method="post" action="{{ route('admin.movies.delete', $movie->id) }}" class="p-6">
                      @csrf
                      @method('delete')

                      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                          {{ __('Are you sure you want to delete this movie?') }}
                      </h2>
                      <p class=" text-red-500">If you delete this movie then all the assosiated shows will be deleted
                          and all the customer that booked that show will get a refund</p>

                      <img id="select_poster_preview" style="height: 5rem" src="{{ $movie->poster_link }}" />
                      <p>Title: {{ $movie->title }} </p>
                      <p>release date: {{ $movie->release_date }}</p>

                      <div class="mt-6 flex justify-end">
                          <x-secondary-button x-on:click="$dispatch('close')">
                              {{ __('Cancel') }}
                          </x-secondary-button>

                          <x-danger-button class="ml-3">
                              {{ __('Delete Movie') }}
                          </x-danger-button>
                      </div>
                  </form>
              </x-modal>
          </div>
          <a href="{{ route('admin.shows.create', $movie->id) }}">
              <x-button.primary class="mt-4">Make a new show</x-button.primary>
          </a>
          @foreach ($movie->genres as $genre)
              <span
                  class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $genre->title }}</span>
          @endforeach
      </div>
  </x-card>
