@props([
    'user' => null,
    'size' => 'sm',
    'href' => null,
])

@php
    $initial = $user?->name ? strtoupper(mb_substr($user->name, 0, 1)) : '?';

    $sizeClasses = [
        'xs' => 'size-7 text-xs',
        'sm' => 'size-8 text-sm',
        'md' => 'size-10 text-base',
        'lg' => 'size-12 text-lg',
    ][$size];
@endphp

@if($href)
    <a
        href="{{$href}}"
    >
@endif
        @if($user?->name)
            <flux:tooltip :content="$user?->name" position="bottom">
        @endif
            <div
                class="flex items-center justify-center bg-zinc-200 font-bold rounded-full border-1 border-zinc-300 {{$sizeClasses}}"
            >
                @if($slot->isNotEmpty())
                    {{$slot}}
                @else
                    {{$initial}}
                @endif
            </div>
        @if($user?->name)
            </flux:tooltip>
        @endif
@if($href)
    </a>
@endif
