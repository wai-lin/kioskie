@props([
    'stores',
])

@php
$href = fn($store) => Auth::check() ? route('stores.show', $store) : route('stores.products', $store);
@endphp

<div class="py-4">
    {{$stores->links()}}
</div>

<section class="grid grid-cols-3 gap-8">
    @if($stores->isEmpty())
        <div class="col-span-3">
            <flux:subheading>No stores found.</flux:subheading>
        </div>
    @endif

    @foreach($stores as $store)
        <x-stores.card :store="$store" :href="$href($store)"/>
    @endforeach
</section>
