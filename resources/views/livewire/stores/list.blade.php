<x-layouts.site class="pt-4 pb-10">
    <flux:heading size="xl" class="flex items-center gap-4">
        <img
            alt=""
            src="{{Vite::asset('resources/images/kiosk.png')}}"
            class="size-8"
        />
        <span>Kiosk Stores</span>
    </flux:heading>

    <x-stores.list :stores="$stores" />
</x-layouts.site>
