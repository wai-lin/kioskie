<x-layouts.app>
    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item :href="route('products.index')">
            Products
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            Create
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <x-form upload :action="route('products.store')" class="max-w-1/3 space-y-6">
        <x-image-upload id="image" name="image" label="Image" />
        <flux:input wire:model="code" label="Code" type="text" size="sm" :value="fake()->unique()->randomNumber(5)" />
        <flux:input wire:model="name" label="Name" type="text" size="sm" />
        <flux:input wire:model="price" label="Price" type="number" size="sm" />

        <div class="flex justify-end gap-4">
            <flux:button size="sm" :href="route('products.index')">Cancel</flux:button>
            <flux:button size="sm" variant="primary" type="submit">Create</flux:button>
        </div>
    </x-form>
</x-layouts.app>
