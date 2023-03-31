<x-app-layout>

    <div class="container mx-auto px-2 ">

        <div class="grid grid-cols-3 gap-4 my-10">
            @foreach ($tickets as $ticket)
                <x-card class="p-2">
                    <p class="text-center font-bold  text-xl">#{{ $ticket->id }}</p>
                    <p>Movie Name: <a href="{{ route('movies.show', $ticket->show->movie->id) }}"
                            class=" font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ $ticket->show->movie->title }}</a>
                    </p>
                    <p>Show Name: <span class=" font-bold">{{ $ticket->show->title }}</span>
                    </p>
                    <p>Show Time: <span class=" font-bold">
                            {{ date('d M, Y h:i A', strtotime($ticket->show->date)) . ' (GMT)' }}</span>
                    <p>Show Time:
                        <span class="cd_show font-bold" data-now="{{ $dateTime }}"
                            data-show_time="{{ $ticket->show->date }}">
                            calculating...
                        </span>
                    </p>
                    <p>Payment Status: <span class=" font-bold">{{ $ticket->payment_status }}</span>
                    <p>Paid Amount: <span class=" font-bold">{{ $ticket->paid_amount }}</span>
                    <p>Seat number: <span class=" font-bold">{{ json_encode($ticket->seat_number) }}</span>

                    <div class="text-center mt-5">
                        @if ($ticket->payment_status != 'paid')
                            <form action="{{ route('ticket.update', $ticket->id) }}" method="post" class="inline">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="payment_status" value="paid">
                                <x-button.primary>Make Payment</x-button.primary>
                            </form>
                            <form action="{{ route('ticket.delete', $ticket->id) }}" method="post" class="inline">
                                @method('DELETE')
                                @csrf

                                <x-danger-button>Delete Ticket</x-danger-button>
                            </form>
                        @else
                            <form action="{{ route('ticket.update', $ticket->id) }}" method="post" class="inline">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="payment_status" value="unpaid">
                                <x-danger-button>Request Refund</x-danger-button>
                            </form>


                            @if ($ticket->type == 'virtual')
                                <a href="{{ route('ticket.vr-show', $ticket->id) }}" class="inline">
                                    <x-button.primary>View in VR</x-button.primary>
                                </a>
                            @else
                                <form action="{{ route('ticket.download', $ticket->id) }}" method="GET"
                                    class="inline">

                                    @csrf

                                    <x-button.primary>Download Ticket

                                    </x-button.primary>
                                </form>
                            @endif
                        @endif



                    </div>
                </x-card>
            @endforeach
        </div>

    </div>




</x-app-layout>
