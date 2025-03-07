@props([
    'stores',
])

<div class="py-4">
    {{$stores->links()}}
</div>

<section class="grid grid-cols-3 gap-8">
    @foreach($stores as $store)
        <x-stores.card :store="$store" :href="route('stores.show', $store->id)"/>
    @endforeach
</section>
