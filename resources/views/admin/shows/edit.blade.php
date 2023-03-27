<x-admin-layout>
    <div class="my-10 px-2 md:px-5 ">
        <x-card class="max-w-3xl mx-auto py-8 px-4">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Show</h2>

            <x-admin.movies.movie-card class=" max-w-sm" :movie="$show->movie" />
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





                <x-primary-button>
                    Submit
                </x-primary-button>
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
