@props([
    'type' => 'success',
    'message' => 'Success message'
])

@php
    $alertColor = [
        'success' => 'green',
        'error' => 'red',
        'warning' => 'yellow',
        'info' => 'indigo',
    ];
    $alertColor = $alertColor[$type] ?? 'info';
@endphp

@if(Session::has($type))
    <x-alert :color="$alertColor" can-close fixed>
        <p>{{$message}}</p>
    </x-alert>
@endif
