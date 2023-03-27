<x-app-layout>

    <div class=" container mx-auto px-2 py-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($shows as $show)
                <div class="border rounded ">
                    <a href="{{ route('shows.show', $show->id) }}" class="block p-4">
                        {{ date('d M, Y h:i A', strtotime($show->date)) . ' (GMT)' }}
                        <p>starting in: <span class="cd_show font-bold" data-now="{{ $dateTime }}"
                                data-show_time="{{ $show->date }}">
                                calculating...
                            </span></p>
                        <p>Movie Name: {{ $show->movie->title }}
                        </p>

                    </a>

                </div>
            @endforeach
        </div>

    </div>




</x-app-layout>
