<x-app-layout>

    <div class="container my-10  mx-auto gap-5 px-2">
        @if ($movies->isEmpty())
            <x-seed-button />
        @endif
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

            @foreach ($movies as $movie)
                <x-movies.movie-card class="" :movie="$movie" :details="false" />
            @endforeach
        </div>
        <div class="my-5 p-2">
            {{ $movies->appends(Request::all())->onEachSide(1)->links('pagination.tailwind') }}
        </div>
    </div>
    <x-modal name="trailer_preview">
        <div class="container-div">
            <iframe id="videoLink" frameborder="0" allowfullscreen class="video"></iframe>
        </div>
    </x-modal>
    <style>
        .container-div {
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

</x-app-layout>
