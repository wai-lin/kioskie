@props([
    'class' => null,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body>
    <div class="container mx-auto {{$class}}">
        {{ $slot }}
    </div>
    @fluxScripts
</body>
</html>
