@props([
    'product',
    'href' => null,
])

<x-card>
    <div class="flex items-end justify-between mb-2">
        <h5 title="{{$product->name}}" class="text-lg font-bold truncate max-w-3/5">
            {{$product->name}}
        </h5>
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
            <flux:dropdown>
                <flux:button size="sm" icon="ellipsis-horizontal" />

                <flux:menu>
                    <flux:menu.item icon="trash" variant="danger">Delete</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        </div>
    </div>
</x-card>
