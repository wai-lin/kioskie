@props([
    'products',
    'store' => null,
    'isOwner' => false,
])

<section class="grid grid-cols-3 gap-8">
    @if($products->isEmpty())
        <div class="col-span-3">
            <flux:subheading>No products found.</flux:subheading>
        </div>
    @endif

    @foreach($products as $product)
        <x-products.card
            :isOwner="$isOwner"
            :product="$product"
            :store="$store"
            :href="route('products.show', $product)"
        />
    @endforeach
</section>
