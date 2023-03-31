<x-admin-layout>
    <div class="my-10 px-2 md:px-5 ">
        <x-card class="max-w-3xl mx-auto py-8 px-4">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Movie</h2>


            <form action="{{ route('admin.movies.update', $movie->id) }}" method="post" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <x-input-label :value="__('Movie title')" />
                    <x-text-input placeholder="Title here" name="title" type="text" :value="old('title', $movie->title)" />
                    <x-input-error class="mt-2" :messages="$errors->get('title')" />

                </div>
                <div>
                    <x-input-label :value="__('Movie synopsis')" />
                    <x-text-input placeholder="Synopsis here" name="synopsis" type="text" :value="old('synopsis', $movie->synopsis)" />
                    <x-input-error class="mt-2" :messages="$errors->get('synopsis')" />

                </div>
                <div>
                    <x-input-label :value="__('Movie trailer link')" />
                    <x-text-input placeholder="trailer link here" name="trailer_link" type="text"
                        :value="old('trailer_link', $movie->trailer_link)" />
                    <x-input-error class="mt-2" :messages="$errors->get('trailer_link')" />

                </div>
                <div>
                    <img id="select_poster_preview" style="height: 5rem"
                        src="{{ old('poster_link', $movie->poster_link) }}" />
                    <x-input-label :value="__('poster link')" />
                    <div class="flex items-center">
                        <x-text-input id="select_poster_input" placeholder="poster_link" name="poster_link"
                            type="text" :value="old('poster_link', $movie->poster_link)" />
                        <x-secondary-button class="mb-0 " id="select_poster_button" data-input="select_poster_input"
                            data-preview="select_poster_preview">
                            Chose</x-secondary-button>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('poster_link')" />

                </div>
                <div>
                    <x-input-label :value="__('Movie release date')" />
                    <x-text-input placeholder="release_date" name="release_date" :value="old('release_date', $movie->release_date)" type="date" />
                    <x-input-error class="mt-2" :messages="$errors->get('release_date')" />

                </div>

                <div class="w-full">

                    <x-input-label :value="__('Movie Genre')" />
                    <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearch"
                        class="inline-flex items-center justify-between w-full text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                        type="button">Select genre
                        <x-ri-arrow-drop-down-line />
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdownSearch" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700">

                        <ul class=" px-3 py-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownSearchButton">
                            @foreach ($genres as $genre)
                                <li>
                                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <input id="checkbox-item-{{ $genre->id }}" type="checkbox"
                                            @if (in_array($genre->id, $movie->genres->pluck('id')->toArray())) checked @endif value="{{ $genre->id }}"
                                            name="genres[]"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="checkbox-item-{{ $genre->id }}"
                                            class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{ $genre->title }}</label>
                                    </div>
                                </li>
                            @endforeach


                        </ul>
                        <a href="{{ route('admin.movies.genres') }}"
                            class="flex items-center p-3 text-sm font-medium text-green-600 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-green-500 hover:underline">

                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z">
                                </path>
                            </svg>
                            Add genre
                        </a>
                    </div>



                    <x-input-error class="mt-2" :messages="$errors->get('genres')" />
                </div>

                <x-button.primary>
                    Submit
                </x-button.primary>
            </form>
        </x-card>
    </div>



    <script>
        var lfm = function(id, type, options) {
            let button = document.getElementById(id);

            button.addEventListener('click', function() {
                var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                var target_input = document.getElementById(button.getAttribute('data-input'));
                var target_preview = document.getElementById('select_poster_preview');

                window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager',
                    'width=900,height=600');
                window.SetUrl = function(items) {
                    var file_path = items.map(function(item) {
                        return item.url;
                    }).join(',');


                    // set the value of the desired input to image url
                    target_input.value = file_path;
                    target_input.dispatchEvent(new Event('change'));

                    // clear previous preview
                    target_preview.innerHtml = '';

                    // set or change the preview image src
                    items.forEach(function(item) {


                        select_poster_preview.setAttribute('src', item.thumb_url)
                    });


                    // trigger change event
                    target_preview.dispatchEvent(new Event('change'));
                };
            });
        };

        lfm('select_poster_button', 'image', {
            type: 'image',
        });
    </script>
</x-admin-layout>
