<x-layouts.site class="pt-28">
    <div class="fixed top-0 left-0 w-full">
        <header class="container mx-auto bg-white py-4 border-b border-zinc-200 px-4">
            <flux:heading size="lg" class="font-normal">Browse products from</flux:heading>
            <flux:heading size="xl">{{$store->name}}</flux:heading>
        </header>
    </div>

    <section class="grid grid-cols-4 gap-8">
        @foreach($store->products as $product)
            <x-products.card
                :product="$product"
            />
        @endforeach
    </section>
</x-layouts.site>
