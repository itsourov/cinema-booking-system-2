<x-admin-layout>
    <div class="my-10 px-2 md:px-5 ">
        <x-card class="max-w-3xl mx-auto py-8 px-4">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Show</h2>

            <div class="max-w-xs">
                @php
                    $movie = $show->movie;
                @endphp
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
                            <p class="text-sm text-gray-500">
                                {{ date('M. d, Y', strtotime($movie->release_date)) }}</p>
                            <p class="text-orange-500 usc">Upcoming Show count :
                                {{ $movie->shows_count }}
                            </p>
                        </div>

                    </div>
                </a>
            </div>
            <form action="{{ route('admin.shows.update', $show->id) }}" method="post" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <x-input-label :value="__('Show title')" />
                    <x-text-input placeholder="Title here" name="title" type="text" :value="old('title', $show->title)" />
                    <x-input-error class="mt-2" :messages="$errors->get('title')" />

                </div>
                <div>
                    <x-input-label :value="__('Show Date and time (GMT)')" />
                    <x-text-input name="date" type="datetime-local" :value="old('date', $show->date)" step="any" />
                    <x-input-error class="mt-2" :messages="$errors->get('date')" />

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
