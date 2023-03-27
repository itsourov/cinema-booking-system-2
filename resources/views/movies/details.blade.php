<x-app-layout>

    <div class="container my-10  mx-auto gap-5 px-2">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 ">
            <div class=" md:col-span-2">


                <x-movies.movie-card class="" :movie="$movie" :details="true" />


            </div>
            <div class=" relative">
                <div class="sticky top-0">

                    <h2>Upcoming Show:</h2>
                    <div class="space-y-2">
                        @foreach ($movie->shows as $show)
                            <div class="border rounded ">
                                <a href="{{ route('shows.show', $show->id) }}" class="block p-4">
                                    {{ date('d M, Y h:i A', strtotime($show->date)) . ' (GMT)' }}
                                </a>
                            </div>
                        @endforeach
                    </div>



                </div>

            </div>
        </div>
    </div>




    <x-modal name="trailer_preview">
        <div class="containerv">
            <iframe id="videoLink" frameborder="0" allowfullscreen class="video"></iframe>
        </div>
    </x-modal>
    <style>
        .containerv {
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
