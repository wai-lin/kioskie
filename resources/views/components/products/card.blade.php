@props([
    'product',
    'href' => null,
])

@php
    $quantity = $product?->pivot?->quantity;
    $quantityColor = $quantity <= 100 ? 'text-red-500' : 'text-zinc-500';
@endphp

<x-card>
    <div class="flex flex-col justify-between mb-4">
        <h5 title="{{$product->name}}" class="text-lg font-bold truncate max-w-[90%]">
            {{$product->name}}
        </h5>

        <p class="text-sm text-zinc-500 flex gap-1">
            <span>{{$product->price}}</span>
            <span>THB</span>
        </p>

        @if($quantity)
            <p class="flex items-end gap-1 text-sm {{$quantityColor}}">
                <span>Qty :</span>
                <span>{{$product->pivot->quantity}}</span>
            </p>
        @endif
    </div>

    <div class="flex items-end justify-between">
        <div>
            @if($href)
                <flux:button size="sm" variant="filled" class="text-xs" :href="$href">
                    View Details
                </flux:button>
            @endif
        </div>

        @auth
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
        @endauth
    </div>
</x-card>
