@props([
    'placeholderWidth' => 100,
    'placeholderHeight' => 100,
    'placeholderText' => '',
    'alt' => '',
    'src' => '',
    'class' => null,
    'id' => null,
])

@php
    $placeholderUrl = "https://placehold.co/{$placeholderWidth}x{$placeholderHeight}/EEE/31343C?font=montserrat&text={$placeholderText}";
    $imgSrc = $src ?: $placeholderUrl;
@endphp

<img id="{{$id}}" alt="{{$alt}}" src="{{$imgSrc}}" class="{{$class}}" />
