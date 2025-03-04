<x-layouts.app>
    <x-page-title class="mb-8">Stores</x-page-title>

    <section class="grid grid-cols-3 gap-8">
        @foreach($stores as $store)
            <x-stores.card :store="$store" :href="route('stores.show', $store->id)"/>
        @endforeach
    </section>
</x-layouts.app>
