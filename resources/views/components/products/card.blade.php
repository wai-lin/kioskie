@props([
    'product',
    'store' => null,
    'href' => null,
    'isOwner' => false,
])

@php
    $quantity = $product?->pivot?->quantity ?? 0;
    $quantityColor = $quantity <= 100 ? 'text-red-500' : 'text-zinc-500';
    $canEditStock = $store && $isOwner;
@endphp

<x-card>
    <div class="flex items-center gap-4">
        <x-image :src="$product->getFirstMediaUrl('products.'.$product->id)" class="size-28 rounded-lg flex-none" />

        <div class="flex-auto">
            <div class="flex flex-col justify-between mb-4">
                <h5 title="{{$product->name}}" class="text-lg font-bold truncate max-w-[90%]">
                    {{$product->name}}
                </h5>

                <p class="text-sm text-zinc-500 flex gap-1">
                    <span>{{$product->price}}</span>
                    <span>THB</span>
                </p>

                @if($quantity > 0)
                    <p class="flex items-end gap-1 text-sm {{$quantityColor}}">
                        <span>Qty :</span>
                        <span>{{$quantity}}</span>
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
                                @if($canEditStock)
                                    <flux:menu.item
                                        icon="inbox-stack"
                                        :href="route('stores.edit_stock', [$store, $product])"
                                    >
                                        Edit Stock
                                    </flux:menu.item>
                                @endif
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
        </div>
    </div>
</x-card>
