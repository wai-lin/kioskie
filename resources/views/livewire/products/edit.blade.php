<x-layouts.app>
    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item :href="route('products.index')">Products</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{$product->name}}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Edit</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <x-form
        method="put"
        :action="route('products.update', $product)"
        class="max-w-1/3 space-y-6"
    >
        <flux:input wire:model="code" label="Code" type="text" size="sm" :value="$product->code"/>
        <flux:input wire:model="name" label="Name" type="text" size="sm" :value="$product->name"/>
        <flux:input wire:model="price" label="Price" type="number" size="sm" :value="$product->price"/>

        <div class="flex justify-end">
            <flux:button size="sm" variant="primary" type="submit">
                Edit
            </flux:button>
        </div>
    </x-form>
</x-layouts.app>
