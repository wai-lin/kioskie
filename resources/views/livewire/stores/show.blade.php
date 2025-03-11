<x-layouts.app>
    <div class="flex items-center justify-between mb-8">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('stores.index')">Stores</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>{{$store->name}}</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <flux:button
            size="sm"
            icon="link"
            variant="primary"
            :href="route('stores.link_products_form', $store)"
        >
            Link Products
        </flux:button>
    </div>

    <x-products.list :products="$store->products" :store="$store" :isOwner="$isOwner" />
</x-layouts.app>
