<x-admin-layout>

    <div class=" px-2 mt-5 space-y-4">

        <x-card class=" max-w-sm mx-auto">
            <form action="{{ route('admin.tickets.update', $ticket) }}" method="post" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <x-input-label :value="__('Paid amount')" />
                    <x-text-input placeholder="amount" name="paid_amount" type="number" :value="old('paid_amount', $ticket->paid_amount)" />
                    <x-input-error class="mt-2" :messages="$errors->get('paid_amount')" />

                </div>
                <div>
                    <x-input-label :value="__('Paid status')" />
                    <select name="payment_status"
                        class=" w-full p-2.5 border border-gray-200 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 focus:outline-none focus:border-blue-600">
                        <option value="" disabled selected>Select a option</option>
                        <option value="paid">paid</option>
                        <option value="unpaid">unpaid</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('payment_status')" />

                </div>
                <x-button.primary>Update</x-button.primary>
            </form>
        </x-card>
    </div>
</x-admin-layout>
