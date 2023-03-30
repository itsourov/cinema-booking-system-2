<div>
    <div class="flex  justify-center items-center">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an
            Seat type</label>
        <select wire:model="seatType"
            class="bg-gray-50 w-min border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option>virtual</option>
            <option>physical</option>


        </select>
    </div>
    <div class="container mx-auto px-2 my-10">


        <div class=" w-fit mx-auto space-y-6">
            @if ($seatType == 'physical')

                @foreach (json_decode($show->seat) as $rowKey => $row)
                    <div class="grid grid-flow-col gap-4">


                        @foreach ($row as $seatKey => $seat)
                            <label for="{{ $rowKey . $seatKey }}_checkbox" wire:click="$emit('countPrice')"
                                class="text-white bg-gray-500 rounded-t-lg w-8 h-7 {{ $seat->status }} {{ in_array($rowKey . $seatKey, $seats) ? 'selected' : '' }} flex items-center justify-center">
                                {{ $rowKey . $seatKey }}</label>
                            <input type="checkbox" wire:model="seats" id="{{ $rowKey . $seatKey }}_checkbox"
                                class="hidden" value="{{ $rowKey . $seatKey }}"
                                {{ $seat->status != 'available' ? 'disabled' : '' }}>
                        @endforeach
                    </div>
                @endforeach
            @else
                <p>Virtual ticket price: {{ $show->virtual_ticket_price }}</p>
                <div class="flex items-center gap-2">
                    <x-text-input placeholder="quantity" wire:model="virtualSeatQty" type="number" />
                    <button class="bg-primary-500 rounded py-1 px-2" wire:click="subtract()">
                        -
                    </button>
                    <button class="bg-primary-500 rounded py-1 px-2" wire:click="add()">
                        +
                    </button>
                </div>
            @endif

        </div>

    </div>
    <div wire:loading>
        <div
            class="fixed z-40 flex tems-center justify-center inset-0 bg-gray-700 dark:bg-gray-900 dark:bg-opacity-50 bg-opacity-50 transition-opacity">
            <div class="flex items-center justify-center ">
                <div class="w-40 h-40 border-t-4 border-b-4 border-green-900 rounded-full animate-spin">
                </div>
            </div>
        </div>
    </div>
    @if ($seats)
        <footer class="mt-20 bg-white dark:bg-gray-700 sticky bottom-0" style="box-shadow: 0 0 10px 0 rgba(0,0,0,.5);">
            <div class=" text-center py-2">
                <x-primary-button class="px-10" style="margin-bottom: 0px" wire:click="makeTicket">Pay
                    {{ $price }}</x-primary-button>
            </div>
            @if (session()->has('message'))
                <div class="alert alert-success text-center">
                    {{ session('message') }}
                </div>
            @endif
        </footer>
    @endif
    @if ($seatType == 'virtual')
        <footer class="mt-20 bg-white dark:bg-gray-700 sticky bottom-0" style="box-shadow: 0 0 10px 0 rgba(0,0,0,.5);">
            <div class=" text-center py-2">
                <x-primary-button class="px-10" style="margin-bottom: 0px" wire:click="makeVirtualTicket">Pay
                    {{ $price }}</x-primary-button>
            </div>
            @if (session()->has('message'))
                <div class="alert alert-success text-center">
                    {{ session('message') }}
                </div>
            @endif
        </footer>
    @endif


</div>
