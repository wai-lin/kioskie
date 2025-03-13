<x-layouts.site class="pt-28">
    <div class="fixed top-0 left-0 w-full">
        <header class="container mx-auto bg-white py-4 border-b border-zinc-200 px-4 flex items-center justify-between">
            <div>
                <flux:heading size="lg" class="font-normal">Browse products from</flux:heading>
                <flux:heading size="xl">{{$store->name}}</flux:heading>
            </div>

            <flux:button type="submit" form="products" size="sm" variant="primary" icon="shopping-bag">
                Order
            </flux:button>
        </header>

    </div>

    <x-form id="products" :action="route('transactions.order')">
        <input type="hidden" name="store_id" value="{{$store->id}}" />
        <flux:error name="products" />
        <flux:error name="store_id" />
        <section class="grid grid-cols-4 gap-8">
            @foreach($store->products as $product)
                <x-products.card :product="$product" name="products[]"/>
            @endforeach
        </section>
    </x-form>
</x-layouts.site>
