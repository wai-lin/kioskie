<x-layouts.app>
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('stores.index')">Stores</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('stores.show', $store)">{{$store->name}}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Link Products</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <x-form
        method="put"
        :action="route('stores.link_products', $store)"
        class="max-w-2/3 space-y-6"
    >
        <div class="grid grid-cols-2 gap-4">
            @foreach($products as $product)
                <article class="flex items-center gap-4 p-4 rounded-md border border-zinc-300">
                    <input
                        id="products.{{$product->id}}"
                        type="checkbox"
                        name="products[]"
                        value="{{$product->id}}"
                        class="flex-none"
                    />
                    <label for="products.{{$product->id}}" class="flex-auto flex items-center gap-4">
                        <x-image :src="$product->getFirstMediaUrl('products.'.$product->id)" class="size-16 rounded-lg" />
                        <span>{{$product->name}}</span>
                    </label>
                </article>
            @endforeach
        </div>

        <div class="flex items-center justify-end gap-4">
            <flux:button size="sm" :href="route('stores.show', $store)">
                Cancel
            </flux:button>

            <flux:button size="sm" variant="primary" type="submit">
                Link
            </flux:button>
        </div>
    </x-form>

</x-layouts.app>
