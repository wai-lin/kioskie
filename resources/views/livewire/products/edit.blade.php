<x-layouts.app>
    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item :href="route('products.index')">Products</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('products.show', $product)">{{$product->name}}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Edit</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <x-form
        upload
        method="put"
        :action="route('products.update', $product)"
        class="max-w-2/3 space-y-6"
    >
        <x-image-upload
            id="image" name="image" label="Image"
            :src="$product->getFirstMediaUrl('products.'.$product->id)"
        />
        <flux:input wire:model="code" label="Code" type="text" size="sm" :value="$product->code"/>
        <flux:input wire:model="name" label="Name" type="text" size="sm" :value="$product->name"/>
        <flux:input wire:model="price" label="Price" type="number" size="sm" :value="$product->price"/>
        <x-rich-text-editor name="description" label="Description" :value="$product->description" />

        <div class="flex justify-end gap-4">
            <flux:button size="sm" :href="route('products.index')">
                Cancel
            </flux:button>
            <flux:button size="sm" variant="primary" type="submit">
                Edit
            </flux:button>
        </div>
    </x-form>
</x-layouts.app>
