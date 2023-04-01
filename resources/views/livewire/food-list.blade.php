<div>
    <div class="container px-2 mx-auto py-10">

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
            @foreach ($foods as $food)
                <div class="">
                    <x-card class="p-2 space-y-3">
                        <img src="{{ $food->image }}" alt="" class="rounded">
                        <div>
                            <h3 class="text-xl font-bold">{{ $food->name }}</h3>
                            <p>Price: {{ $food->price }} GBP</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <x-text-input placeholder="quantity" wire:model="selected.index{{ $food->id }}.qty"
                                type="number" />
                            <button class="bg-primary-500 rounded py-1 px-2"
                                wire:click="subtract('{{ $food->id }}')">
                                -
                            </button>
                            <button class="bg-primary-500 rounded py-1 px-2" wire:click="add('{{ $food->id }}')">
                                +
                            </button>
                        </div>


                    </x-card>
                </div>
            @endforeach
        </div>

        @if ($hasMorePages)
            <div class="flex items-center justify-center mt-4">
                <x-button.primary wire:click="loadFoods">Load more</x-button.primary>
            </div>
        @endif
    </div>


    @if ($selected)
        <footer class="mt-20 bg-white dark:bg-gray-700 sticky bottom-0" style="box-shadow: 0 0 10px 0 rgba(0,0,0,.5);">
            <div class=" text-center py-2">
                <x-button.primary class="px-10" style="margin-bottom: 0px" wire:click="makeOrder">Pay
                    {{ $price }}</x-button.primary>
            </div>
            @if (session()->has('message'))
                <div class="alert alert-success text-center">
                    {{ session('message') }}
                </div>
            @endif
        </footer>
    @endif
</div>
