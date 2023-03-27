<x-app-layout>

    <div class="container mx-auto px-2 ">

        <div class="grid grid-cols-3 gap-4 my-10">
            @foreach ($orders as $order)
                <x-card class="p-2">
                    <p class="text-center font-bold  text-xl">#{{ $order->id }}</p>

                    <p class="text-center">Customer name: <span class=" font-bold">{{ $order->user->name }}</span></p>

                    <p class="text-center">Payment status: <span class=" font-bold">{{ $order->payment_status }}</span>
                    </p>

                    <p class="text-center">Order Price: <span class=" font-bold">{{ $order->price }}</span> currency</p>

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

                                <tr>
                                    <th scope="col" class="px-6 py-3">Id</th>
                                    <th scope="col" class="px-6 py-3">Food Name</th>
                                    <th scope="col" class="px-6 py-3">Food price</th>
                                    <th scope="col" class="px-6 py-3">QTY</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->foods as $id => $food)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $id }}
                                            </td>
                                        <td class="px-6 py-4">{{ $food['name'] }}</td>
                                        <td class="px-6 py-4">{{ $food['price'] }}</td>
                                        <td class="px-6 py-4">{{ $food['qty'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                    <div class="text-center mt-5">
                        @if ($order->payment_status != 'paid')
                            <form action="{{ route('food-order.update', $order->id) }}" method="post" class="inline">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="payment_status" value="paid">
                                <x-primary-button>Make Payment</x-primary-button>
                            </form>
                            <form action="{{ route('food-order.delete', $order->id) }}" method="post" class="inline">
                                @method('DELETE')
                                @csrf

                                <x-danger-button>Delete Ticket</x-danger-button>
                            </form>
                        @else
                            <form action="{{ route('food-order.update', $order->id) }}" method="post" class="inline">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="payment_status" value="unpaid">
                                <x-danger-button>Request Refund</x-danger-button>
                            </form>
                        @endif



                    </div>
                </x-card>
            @endforeach
        </div>
        <div class="my-5">
            {{ $orders->links('pagination.tailwind') }}
        </div>
    </div>




</x-app-layout>
