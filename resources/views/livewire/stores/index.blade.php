<x-layouts.app>
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item>Stores</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <section class="grid grid-cols-3 gap-8">
        @foreach($stores as $store)
            <x-stores.card :store="$store" :href="route('stores.show', $store->id)"/>
        @endforeach
    </section>
</x-layouts.app>
