<x-admin-layout>
    <div class="my-10 px-2 md:px-5 ">
        <x-card class="max-w-3xl mx-auto py-8 px-4">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Create Food</h2>



            <form action="{{ route('admin.foods.create') }}" method="post" class="space-y-6">
                @csrf
                @method('POST')
                <div>
                    <x-input-label :value="__('Food name')" />
                    <x-text-input placeholder="name here" name="name" type="text" :value="old('name')" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />

                </div>
                <div>
                    <x-input-label :value="__('price GBP')" />
                    <x-text-input placeholder="price here" name="price" type="number" :value="old('price')" />
                    <x-input-error class="mt-2" :messages="$errors->get('price')" />

                </div>

                <img id="select_poster_preview" />
                <div>
                    <x-input-label :value="__('image')" />
                    <x-text-input placeholder="image here" name="image" type="text" id="image-food"
                        :value="old('image')" />
                    <button id="select_poster_button" type="button" data-input="image-food"
                        class="border rounded p-1 dark:border-gray-700">Select Image</button>
                    <x-input-error class="mt-2" :messages="$errors->get('image')" />

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
