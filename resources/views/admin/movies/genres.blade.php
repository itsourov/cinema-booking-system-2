<x-admin-layout>
    <div class="px-2 sm:px-5 my-10">
        <div class=" grid grid-cols-1 lg:grid-cols-5 gap-3 ">
            <div class="lg:col-span-2">
                <div
                    class=" p-3 lg:p-5 mb-5 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 text-gray-900 dark:text-gray-100">

                    <h3 class="text-lg font-bold ">Add new Genre</h3>

                    <form action="{{ route('admin.movies.genres') }}" method="post" class="mt-2 space-y-6">
                        @csrf



                        <div>
                            <x-input-label for="genre_title" :value="__('Genre title')" />
                            <x-text-input id="genre_title" placeholder="Title here" name="title" type="text"
                                class="mt-1 block w-full" :value="old('title')" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="genre_slug" :value="__('Genre slug')" />
                            <x-text-input id="genre_slug" name="slug" placeholder="slug" type="text"
                                class="mt-1 block w-full" :value="old('slug')" />
                            <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                        </div>
                        <div>
                            <x-input-label for="genre_desc" :value="__('Genre description')" />
                            <x-text-input id="genre_slug" name="description" placeholder="description" type="text"
                                class="mt-1 block w-full" :value="old('description')" />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>



                        <div class="flex items-center gap-4">
                            <x-button.primary>{{ __('Save') }}</x-button.primary>
                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                            @endif
                        </div>

                    </form>
                </div>

            </div>
            <div class="lg:col-span-3">
                <div
                    class="relative overflow-x-auto sm:rounded-lg   mb-5 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 text-gray-900 dark:text-gray-100">




                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-all-search" type="checkbox"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Posts
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    ACTION
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    DATE
                                </th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($genres as $genre)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 ">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-table-search-1" type="checkbox"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <th scope="row"
                                        class="flex px-6 py-4 font-medium text-gray-900  dark:text-white">


                                        <div class="flex items-center text-sm">
                                            <!-- Avatar with inset shadow -->

                                            <div>
                                                <p class="font-semibold">{{ $genre->title }}</p>
                                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                                    {{ $genre->description }}
                                                </p>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $genre->movies_count }}
                                    </td>
                                    <td class="flex items-center px-6 py-4 space-x-3">
                                        {{-- <a href="{{ route('admin.posts.edit', $genre) }}"
                                            class="inline mx-1 px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                            Edit
                                        </a> --}}
                                        {{-- <a href="{{ route('posts.details', $Genre) }}"
                                            class="inline mx-1 px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                            View
                                        </a>
                                        <form action="{{ route('admin.posts.delete', $Genre) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class=" inline mx-1 px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                Delete
                                            </button>
                                        </form> --}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $genre->created_at->format('d/m/y') }}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="my-5">
                        {{ $genres->appends(Request::all())->onEachSide(1)->links('pagination.tailwind') }}
                    </div>

                </div>
            </div>
        </div>
    </div>


</x-admin-layout>
