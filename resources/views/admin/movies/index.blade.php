<x-admin-layout>

    <div class=" px-2 mt-5 space-y-4">
        <h2 class=" text-base font-bol text-gray-800 dark:text-gray-100">Latest movies</h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5  gap-x-2 gap-y-6">
            @foreach ($movies as $movie)
                <div href="{{ route('admin.movies.edit', $movie->id) }}">


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
                            <p class="text-sm text-gray-500">{{ date('M. d, Y', strtotime($movie->release_date)) }}</p>

                        </div>
                        <div class="flex justify-center gap-2 ">
                            <a href="{{ route('admin.movies.edit', $movie->id) }}"
                                class="bg-green-200 dark:bg-green-800 rounded px-2 py-1">
                                <x-ri-edit-2-fill />
                            </a>
                            <a href="{{ route('movies.show', $movie->id) }}"
                                class="bg-green-200 dark:bg-green-800 rounded px-2 py-1">
                                <x-ri-eye-fill />
                            </a>
                            <button class="bg-red-200 dark:bg-red-800 rounded px-2 py-1" x-data=""
                                x-on:click.prevent=" $dispatch('open-modal', 'confirm-movie-deletion{{ $movie->id }}')">
                                <x-ri-delete-bin-5-fill />
                            </button>




                            <x-modal name="confirm-movie-deletion{{ $movie->id }}" focusable>
                                <form method="post" action="{{ route('admin.movies.delete', $movie->id) }}"
                                    class="p-6">
                                    @csrf
                                    @method('delete')

                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Are you sure you want to delete this movie?') }}
                                    </h2>
                                    <p class=" text-red-500">If you delete this movie then all the assosiated shows will
                                        be deleted
                                        and all the customer that booked that show will get a refund</p>

                                    <img id="select_poster_preview" style="height: 5rem"
                                        src="{{ $movie->poster('w500') }}" />
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
                        <div class="flex m-2">
                            <a href=""
                                class="w-full rounded bg-primary-500 px-3 py-1 text-white text-center">Make a new
                                show</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="">
            {{ $movies->appends(Request::all())->onEachSide(1)->links('pagination.tailwind') }}
        </div>

    </div>



    <x-modal name="trailer_preview">
        <div class="container">
            <iframe id="videoLink" frameborder="0" allowfullscreen class="video"></iframe>
        </div>
    </x-modal>
    <style>
        .container {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 56.25%;
        }

        .video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>

    <script>
        function openModal(el) {

            // alert('asd')

            var iframe = document.getElementById('videoLink')
            var src = el.target.getAttribute('data-trailer')
            iframe.setAttribute('src', 'https://www.youtube.com/embed/' + getId(src))

        }

        function getId(url) {
            const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
            const match = url.match(regExp);

            return (match && match[2].length === 11) ?
                match[2] :
                null;
        }
    </script>


</x-admin-layout>
