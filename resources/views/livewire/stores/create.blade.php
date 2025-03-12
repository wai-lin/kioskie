<x-layouts.app>
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('stores.index')">Stores</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Create</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <x-form upload :action="route('stores.store')" class="max-w-1/3 space-y-6">
        <x-image-upload id="logo" name="logo" label="Logo" />

        <flux:input wire:model="name" label="Name" type="text" size="sm"/>

        <div class="flex justify-end gap-4">
            <flux:button size="sm" :href="route('stores.index')">Cancel</flux:button>
            <flux:button size="sm" variant="primary" type="submit">Create</flux:button>
        </div>
    </x-form>

</x-layouts.app>

