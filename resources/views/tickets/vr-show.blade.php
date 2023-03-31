<x-app-layout>
    <div class="container mx-auto px-2 py-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @for ($i = 0; $i < $ticket->qty; $i++)
                <a href="{{ route('videojs.view', $ticket->id) }}">
                    <x-button.primary>Virtual seat #{{ $i + 1 }}</x-button.primary>
                </a>
            @endfor
        </div>
    </div>
</x-app-layout>
