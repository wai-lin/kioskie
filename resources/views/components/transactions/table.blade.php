@props([
    'transactions',
])

<div class="py-4">
    {{$transactions->links()}}
</div>

<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Store name
            </th>
            <th scope="col" class="px-6 py-3">
                Product name
            </th>
            <th scope="col" class="px-6 py-3">
                Actor name
            </th>
            <th scope="col" class="px-6 py-3">
                Action
            </th>
            <th scope="col" class="px-6 py-3">
                Amount
            </th>
            <th scope="col" class="px-6 py-3 text-right">
                Price
            </th>
            <th scope="col" class="px-6 py-3">
                Date
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($transactions as $transaction)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <td class="px-6 py-4">
                    <flux:link :href="route('stores.show', $transaction->store)">
                        {{$transaction->store->name}}
                    </flux:link>
                </td>
                <td class="px-6 py-4">
                    <flux:link :href="route('products.show', $transaction->product)">
                        {{$transaction->product->name}}
                    </flux:link>
                </td>
                <td class="px-6 py-4">
                    {{$transaction?->actor?->name ?: '-'}}
                </td>
                <td class="px-6 py-4">
                    {{$transaction->action}}
                </td>
                <td class="px-6 py-4">
                    {{$transaction->amount ?: '-'}}
                </td>
                <td class="px-6 py-4 text-right">
                    {{$transaction->price}} THB
                </td>
                <td class="px-6 py-4" data-datetime="{{$transaction->created_at}}">
                    {{$transaction->created_at?->format('d M, Y (h:i:s A) e')}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@once
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/plugin/utc.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            dayjs.extend(window.dayjs_plugin_utc);
            document.querySelectorAll('[data-datetime]').forEach((element) => {
                const datetime = element.getAttribute('data-datetime');
                const formattedDate = dayjs
                    .utc(datetime)
                    .local()
                    .format('DD MMM, YYYY (hh:mm:ss A)');
                element.textContent = formattedDate;
            });
        });
    </script>
@endonce
