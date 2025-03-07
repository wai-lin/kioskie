<x-layouts.app>
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

    <section class="grid grid-cols-4 gap-8">
        @foreach($products as $product)
            <x-products.card
                :product="$product"
                :href="route('products.show', $product)"
            />
        @endforeach
    </section>
</x-layouts.app>
