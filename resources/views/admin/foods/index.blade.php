<x-admin-layout>

    <div class=" px-2 mt-5 space-y-4">
        <h2 class=" text-base font-bol text-gray-800 dark:text-gray-100">Foods</h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5  gap-x-2 gap-y-6">
            @foreach ($foods as $food)
                <div>


                    <div
                        class="border dark:border-gray-800 dark:shadow dark:shadow-gray-800 dark:bg-gray-900 rounded-md overflow-clip group">
                        <div class="poster overflow-clip relative">
                            <img src="{{ $food->image }}" alt=""
                                class="object-cover w-full  group-hover:scale-110 transition duration-300 ease-in-out">


                        </div>
                        <div class="p-2">
                            <p class="truncate text-black dark:text-white">{{ $food->name }}</p>
                            <p class="truncate text-black dark:text-white">Price: {{ $food->price }} GBP</p>

                        </div>
                        <div class="flex justify-center gap-2 ">
                            <a href="{{ route('admin.foods.edit', $food->id) }}"
                                class="bg-green-200 dark:bg-green-800 rounded px-2 py-1">
                                <x-ri-edit-2-fill />
                            </a>

                            <button class="bg-red-200 dark:bg-red-800 rounded px-2 py-1" x-data=""
                                x-on:click.prevent=" $dispatch('open-modal', 'confirm-movie-deletion{{ $food->id }}')">
                                <x-ri-delete-bin-5-fill />
                            </button>




                            <x-modal name="confirm-movie-deletion{{ $food->id }}" focusable>
                                <form method="post" action="{{ route('admin.foods.delete', $food->id) }}"
                                    class="p-6">
                                    @csrf
                                    @method('delete')

                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Are you sure you want to delete this movie?') }}
                                    </h2>
                                    <p class=" text-red-500">If you delete this food then all the assosiated order will
                                        be deleted
                                        and all the customer that bought this food will get a refund</p>

                                    <img id="select_poster_preview" style="height: 5rem" src="{{ $food->image }}" />
                                    <p>Name: {{ $food->name }} </p>
                                    <p>price: {{ $food->price }} GBP </p>

                                    <div class="mt-6 flex justify-end">
                                        <x-button.secondary x-on:click="$dispatch('close')">
                                            {{ __('Cancel') }}
                                        </x-button.secondary>

                                        <x-button.danger class="ml-3">
                                            {{ __('Delete Movie') }}
                                        </x-button.danger>
                                    </div>
                                </form>
                            </x-modal>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
        <div class="">
            {{ $foods->appends(Request::all())->onEachSide(1)->links('pagination.tailwind') }}
        </div>

    </div>





</x-admin-layout>
