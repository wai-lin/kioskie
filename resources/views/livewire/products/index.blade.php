<x-layouts.app>

    <x-notification type="success" :message="Session::get('success')" />
    <x-notification type="info" :message="Session::get('info')" />

    <div class="mb-4 flex items-center justify-between">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item>Products</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <flux:button size="sm" variant="primary" icon="squares-plus" :href="route('products.create')">
            Create Product
        </flux:button>
    </div>

    <div class="py-4">
        {{$products->links()}}
    </div>

    <x-products.list :products="$products" />

</x-layouts.app>
