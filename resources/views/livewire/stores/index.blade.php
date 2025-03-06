<x-layouts.app>
    @if(Session::has('success'))
        <div class="my-4">
            <x-alert>
                {{Session::get('success')}}
            </x-alert>
        </div>
    @endif

    <div class="mb-4 flex items-center justify-between">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item>Stores</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <flux:button size="sm" variant="primary" icon="squares-plus" :href="route('stores.create')">
            Create Store
        </flux:button>
    </div>

    <div class="py-4">
        {{$stores->links()}}
    </div>

    <section class="grid grid-cols-3 gap-8">
        @foreach($stores as $store)
            <x-stores.card :store="$store" :href="route('stores.show', $store->id)"/>
        @endforeach
    </section>
</x-layouts.app>
