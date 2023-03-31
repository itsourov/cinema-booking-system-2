<x-app-layout>

    <div class="container mx-auto px-2 ">

        <x-card class="container mx-auto my-10 py-6 px-2 ">
            <h2 class=" text-center font-bold text-xl underline">Payment Page</h2>

            <div class="mt-10">
                <p class="text-center">Customer name: <span class=" font-bold">{{ $order->user->name }}</span></p>

                <p class="text-center">Payment status: <span class=" font-bold">{{ $order->payment_status }}</span>

                <p class="text-center">Order Price: <span class=" font-bold">{{ $order->price }}</span>
            </div>

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

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
                    <form action="{{ route('food-order.update', $order->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="payment_status" value="paid">
                        <x-button.primary>Make Payment</x-button.primary>
                    </form>
                    <form action="{{ route('food-order.delete', $order->id) }}" method="post">
                        @method('DELETE')
                        @csrf

                        <x-button.danger>Delete Order</x-button.danger>
                    </form>
                @else
                    <form action="{{ route('food-order.update', $order->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="payment_status" value="unpaid">
                        <x-button.danger>Request Refund</x-button.danger>
                    </form>
                @endif



            </div>


        </x-card>

    </div>




</x-app-layout>
