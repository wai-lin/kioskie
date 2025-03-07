@props([
    'color' => 'green',
])

@php
    $theme = [
        'green' => ['bg-green-100', 'text-green-900'],
        'red' => ['bg-red-100', 'text-red-900'],
        'blue' => ['bg-blue-100', 'text-blue-900'],
        'yellow' => ['bg-yellow-100', 'text-yellow-900'],
        'indigo' => ['bg-indigo-100', 'text-indigo-900'],
    ][$color];
@endphp

<div
    x-data="{ open: true }"
    x-show="open"
    class="
        px-8
        py-4
        rounded-lg
        grid
        grid-cols-[1fr_30px]
        gap-4
        fixed
        right-4
        top-4
        z-10
        shadow-md
        {{$theme[0]}}
        {{$theme[1]}}
    "
>
    <div>{{$slot}}</div>
    <flux:button size="xs" icon="x-mark" variant="filled" @click="open = false" />
</div>
