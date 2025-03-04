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
        space-y-6
        ring-offset-2
        ring-zinc-500
        hover:ring-1
    "
>
    <div class="flex items-end justify-between">
        <h5 class="text-lg font-bold">{{$store->name}}</h5>

        <p class="text-sm text-zinc-500">
            {{$productsCount}} product{{$productsCount > 1 ? "s" : ""}}
        </p>
    </div>

    <div class="flex items-end justify-between">
        <div class="space-y-2">
            <h6 class="text-sm text-zinc-500">Owners</h6>

            <div class="flex items-center gap-1">
                @foreach($first2Owners as $owner)
                    <x-avatar :user="$owner"/>
                @endforeach

                @if($store->owners->count() > 2)
                    <x-avatar>
                        +{{$store->owners->count() - 2}}
                    </x-avatar>
                @endif
            </div>
        </div>

        @if($href)
            <flux:button size="sm" href="{{$href}}">View Details</flux:button>
        @endif
    </div>
</article>
