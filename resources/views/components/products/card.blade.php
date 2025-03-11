@props([
    'product',
    'href' => null,
])

<x-card>
    <div class="flex flex-col justify-between mb-4">
        <h5 title="{{$product->name}}" class="text-lg font-bold truncate max-w-[90%]">
            {{$product->name}}
        </h5>

        <p class="text-sm text-gray-500 flex gap-1">
            <span>{{$product->price}}</span>
            <span>THB</span>
        </p>
    </div>

    <div class="flex items-end justify-between">
        <div>
            @if($href)
                <flux:button size="sm" variant="filled" class="text-xs" :href="$href">
                    View Details
                </flux:button>
            @endif
        </div>

        <div>
            <x-form
                method="delete"
                id="products.delete.{{$product->id}}"
                :action="route('products.destroy', $product)"
            />

            <flux:dropdown>
                <flux:button size="sm" icon="ellipsis-horizontal"/>

                <flux:menu>
                    <flux:menu.item
                        icon="pencil"
                        :href="route('products.edit', $product)"
                    >
                        Edit
                    </flux:menu.item>
                    <flux:menu.item
                        icon="trash"
                        variant="danger"
                        type="submit"
                        form="products.delete.{{$product->id}}"
                    >
                        Delete
                    </flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        </div>
    </div>
</x-card>
