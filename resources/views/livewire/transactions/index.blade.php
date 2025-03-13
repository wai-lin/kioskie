<x-layouts.app>
    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item>Transactions</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <x-transactions.table :transactions="$transactions" />
</x-layouts.app>
