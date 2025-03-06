<x-layouts.app>
    <div class="mb-8 flex items-center justify-between">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item>Stores</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <flux:button size="sm" variant="primary" icon="squares-plus" :href="route('stores.create')">
            Create Store
        </flux:button>
    </div>

    <section class="grid grid-cols-3 gap-8">
        @foreach($stores as $store)
            <x-stores.card :store="$store" :href="route('stores.show', $store->id)"/>
        @endforeach
    </section>
</x-layouts.app>
