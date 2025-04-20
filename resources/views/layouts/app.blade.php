<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans bg-gray-50">
@if(!request()->routeIs('login', 'register'))
    @livewire('navigation')
@endif

<!-- Dynamic Content Area -->
<main class="container mx-auto px-4 py-6 min-h-screen">
    @yield('content') <!-- For traditional Blade views -->
    {{ $slot ?? '' }} <!-- For Livewire components -->
</main>

@livewireScripts
<script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
