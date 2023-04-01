<x-admin-layout>
    <div class="my-10 px-2 md:px-5 ">
        <x-card class="max-w-3xl mx-auto py-8 px-4">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Food</h2>


            <form action="{{ route('admin.foods.update', $food->id) }}" method="post" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <x-input-label :value="__('Show name')" />
                    <x-text-input placeholder="name here" name="name" type="text" :value="old('name', $food->name)" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />

                </div>
                <div>
                    <x-input-label :value="__('price GBP')" />
                    <x-text-input placeholder="price here" name="price" type="number" :value="old('price', $food->price)" />
                    <x-input-error class="mt-2" :messages="$errors->get('price')" />

                </div>


                <img id="select_poster_preview" />
                <div>
                    <x-input-label :value="__('image')" />
                    <x-text-input placeholder="image here" name="image" type="text" id="image-food"
                        :value="old('image', $food->image)" />
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




</x-admin-layout>
