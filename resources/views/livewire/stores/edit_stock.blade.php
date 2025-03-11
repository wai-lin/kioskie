<x-layouts.app>
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('stores.index')">Stores</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('stores.show', $store)">{{$store->name}}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Edit Stock of {{$product->name}}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <x-form method="put" :action="route('stores.edit_stock', compact('store', 'product'))" class="max-w-1/3 space-y-6">
        <flux:select wire:model="action">
            <flux:select.option value="restock">Restock</flux:select.option>
            <flux:select.option value="deplete">Deplete</flux:select.optionkk>
        </flux:select>

        <flux:input wire:model="amount" type="number" />

        <div class="flex items-center justify-end gap-4">
            <flux:button size="sm" :href="route('stores.show', $store)">
                Cancel
            </flux:button>
            <flux:button size="sm" variant="primary" type="submit">
                Update
            </flux:button>
        </div>
    </x-form>
</x-layouts.app>
