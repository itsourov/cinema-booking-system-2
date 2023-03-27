<div>
    <div class="container mx-auto px-2 my-10">


        <div class=" w-fit mx-auto space-y-6">
            @foreach (json_decode($show->seat) as $rowKey => $row)
                <div class="grid grid-flow-col gap-4">


                    @foreach ($row as $seatKey => $seat)
                        <label for="{{ $rowKey . $seatKey }}_checkbox" wire:click="$emit('countPrice')"
                            class="text-white bg-gray-500 rounded-t-lg w-8 h-7 {{ $seat->status }} {{ in_array($rowKey . $seatKey, $seats) ? 'selected' : '' }} flex items-center justify-center">
                            {{ $rowKey . $seatKey }}</label>
                        <input type="checkbox" wire:model="seats" id="{{ $rowKey . $seatKey }}_checkbox" class="hidden"
                            value="{{ $rowKey . $seatKey }}" {{ $seat->status != 'available' ? 'disabled' : '' }}>
                    @endforeach
                </div>
            @endforeach


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


</div>
