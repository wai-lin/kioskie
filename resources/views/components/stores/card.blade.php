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
        ring-zinc-500
        hover:ring-1
    "
>
    <div class="flex items-end justify-between mb-2">
        <h5 class="text-lg font-bold">{{$store->name}}</h5>

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

        @if($href)
            <flux:button size="sm" href="{{$href}}">View Details</flux:button>
        @endif
    </div>
</article>
