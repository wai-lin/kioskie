<div
    x-data="{ open: true }"
    x-show="open"
    class="
        px-8
        py-4
        rounded-lg
        bg-green-100
        text-green-900
        grid
        grid-cols-[1fr_30px]
        gap-4
        absolute
        right-4
        top-4
    "
>
    <div>{{$slot}}</div>
    <flux:button size="xs" icon="x-mark" variant="filled" @click="open = false" />
</div>
