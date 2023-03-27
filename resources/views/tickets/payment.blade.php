<x-app-layout>

    <div class="container mx-auto px-2 ">

        <x-card class="container mx-auto my-10 py-6 px-2 ">
            <h2 class=" text-center font-bold text-xl underline">Payment Page</h2>

            <div class="mt-10">
                <p class="text-center">Customer name: <span class=" font-bold">{{ $ticket->user->name }}</span></p>
                <p class="text-center">Show Name: <span class=" font-bold">{{ $ticket->show->title }}</span></p>
                <p class="text-center">Movie Name: <span class=" font-bold">{{ $ticket->show->movie->title }}</span></p>
                <p class="text-center">Show Time: <span class=" font-bold">{{ $ticket->show->date }} GMT</span>
                <p class="text-center">Show Time:
                    <span class="cd_show font-bold" data-now="{{ $dateTime }}"
                        data-show_time="{{ $ticket->show->date }}">
                        calculating...
                    </span>
                </p>
                <p class="text-center">Payment status: <span class=" font-bold">{{ $ticket->payment_status }}</span>
                <p class="text-center">Seat number: <span
                        class=" font-bold">{{ json_encode($ticket->seat_number) }}</span>
                <p class="text-center">Ticket Price: <span class=" font-bold">{{ $price }}</span>
            </div>
            <div class="text-center mt-5">
                @if ($ticket->payment_status != 'paid')
                    <form action="{{ route('ticket.update', $ticket->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="payment_status" value="paid">
                        <x-primary-button>Make Payment</x-primary-button>
                    </form>
                    <form action="{{ route('ticket.delete', $ticket->id) }}" method="post">
                        @method('DELETE')
                        @csrf

                        <x-danger-button>Delete Ticket</x-danger-button>
                    </form>
                @else
                    <form action="{{ route('ticket.update', $ticket->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="payment_status" value="unpaid">
                        <x-danger-button>Request Refund</x-danger-button>
                    </form>

                    <div class="flex justify-center">
                        <a href="{{ route('ticket.download', $ticket->id) }}">
                            <x-primary-button class="flex  items-center space-x-2">
                                <span>Download Ticket</span>
                                <x-ri-download-2-fill />
                            </x-primary-button>
                        </a>

                    </div>
                @endif



            </div>


        </x-card>

    </div>




</x-app-layout>
