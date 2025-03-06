<x-layouts.app>
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('stores.index')">Stores</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{$store->name}}</flux:breadcrumbs.item>
    </flux:breadcrumbs>
</x-layouts.app>
