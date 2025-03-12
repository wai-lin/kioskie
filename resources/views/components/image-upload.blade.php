@props([
    'label',
    'name',
    'id',
    'src' => null,
])

<div class="flex items-center justify-between gap-4">
    <flux:input
        wire:model="{{$name}}" :id="$id" :label="$label"
        type="file" accept="image/*"
        size="sm" class="flex-auto"
    />
    <x-image id="{{$id}}-preview" :src="$src" class="flex-none size-24 rounded-lg bg-zinc-200"/>
</div>

@once
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('{{$id}}').addEventListener('change', function (event) {
                const file = event.target.files[0];

                if (file) {
                    const reader = new FileReader();

                    console.log("File selected:", file.name);

                    reader.onload = function (e) {
                        document.getElementById('{{$id}}-preview').src = e.target.result;
                    };

                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endonce
