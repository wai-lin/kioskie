<x-layouts.app>

    <x-notification type="success" :message="Session::get('success')" />
    <x-notification type="info" :message="Session::get('info')" />

    <div class="mb-4 flex items-center justify-between">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item>Stores</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <flux:button size="sm" variant="primary" icon="squares-plus" :href="route('stores.create')">
            Create Store
        </flux:button>
    </div>

    <x-stores.list :stores="$stores" />

</x-layouts.app>
