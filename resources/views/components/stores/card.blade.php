@props([
    'store',
    'href' => null,
])

@php
    $productsCount = $store->products->count();
    $first2Owners = $store->owners->take(2);
@endphp

<article
    class="
        bg-white
        rounded-xl
        border
        border-zinc-300
        py-4
        px-8
        ring-offset-2
        ring-yellow-500
        hover:ring-1
    "
>
    <div class="flex items-end justify-between mb-2">
        <h5 title="{{$store->name}}" class="text-lg font-bold truncate max-w-3/5">
            {{$store->name}}
        </h5>

        <p class="text-sm text-zinc-500">
            {{$productsCount}} product{{$productsCount > 1 ? "s" : ""}}
        </p>
    </div>

    <div class="flex items-center gap-1 mb-6">
        <h6 class="text-sm text-zinc-500">Owners :</h6>

        <div class="flex items-center gap-0.5">
            @foreach($first2Owners as $owner)
                <x-avatar size="xs" :user="$owner"/>
            @endforeach

            @if($store->owners->count() > 2)
                <x-avatar size="xs">
                    +{{$store->owners->count() - 2}}
                </x-avatar>
            @endif
        </div>
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
</article>
