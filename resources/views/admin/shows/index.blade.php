<x-admin-layout>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 p-2 mt-6">
        @foreach ($shows as $show)
            <x-card class="flex">



                <img src="{{ $show->movie->poster_link }}" alt="" class=" w-1/3 object-cover">
                <div class="p-2 ">
                    <h2 class="font-bold text-lg">{{ $show->title }}</h2>
                    <p class="text-red-500 inline">happening in:</p>
                    <p class="cd_show inline" data-now="{{ $dateTime }}" data-show_time="{{ $show->date }}">
                        calculating...
                    </p>
                    <x-button.secondary data-trailer="{{ $show->movie->trailer_link }}" x-data=""
                        x-on:click.prevent="openModal(event), $dispatch('open-modal', 'trailer_preview')">Preview
                        Trailer</x-button.secondary>
                    <div class="flex gap-2 mt-2">
                        <a href="{{ route('admin.shows.edit', $show->id) }}"
                            class="bg-green-200 dark:bg-green-800 rounded px-2 py-1">
                            <x-ri-edit-2-fill />
                        </a>
                        <a href="{{ route('admin.shows.show', $show->id) }}"
                            class="bg-green-200 dark:bg-green-800 rounded px-2 py-1">
                            <x-ri-eye-fill />
                        </a>
                        <button class="bg-red-200 dark:bg-red-800 rounded px-2 py-1" x-data=""
                            x-on:click.prevent=" $dispatch('open-modal', 'confirm-show-deletion{{ $show->id }}')">
                            <x-ri-delete-bin-5-fill />
                        </button>


                        <x-modal name="confirm-show-deletion{{ $show->id }}" focusable>
                            <form method="post" action="{{ route('admin.shows.delete', $show->id) }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Are you sure you want to delete this Show?') }}
                                </h2>
                                <p class=" text-red-500">If you delete this show then all the customer that booked that
                                    show will get a refund</p>
                                <img id="select_poster_preview" style="height: 5rem"
                                    src="{{ $show->movie->poster_link }}" />
                                <p>Title: {{ $show->title }} </p>
                                <p> date: {{ $show->date }}</p>

                                <p class="text-red-500 inline">happening in:</p>
                                <p class="cd_show inline" data-now="{{ $dateTime }}"
                                    data-show_time="{{ $show->date }}">
                                    calculating...
                                </p>
                                <div class="mt-6 flex justify-end">
                                    <x-button.secondary x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-button.secondary>

                                    <x-button.danger class="ml-3">
                                        {{ __('Delete Show') }}
                                    </x-button.danger>
                                </div>
                            </form>
                        </x-modal>
                    </div>

                </div>
            </x-card>
        @endforeach


    </div>
    <div class="my-5 p-2">
        {{ $shows->appends(Request::all())->onEachSide(1)->links('pagination.tailwind') }}
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
