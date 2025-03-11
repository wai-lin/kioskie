@props([
    'products',
    'store' => null,
    'isOwner' => false,
])

<section class="grid grid-cols-4 gap-8">
    @foreach($products as $product)
        <x-products.card
            :isOwner="$isOwner"
            :product="$product"
            :store="$store"
            :href="route('products.show', $product)"
        />
    @endforeach
</section>
