@props([
    'products',
])

<section class="grid grid-cols-4 gap-8">
    @foreach($products as $product)
        <x-products.card
            :product="$product"
            :href="route('products.show', $product)"
        />
    @endforeach
</section>
