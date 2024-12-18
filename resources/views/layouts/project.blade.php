<!DOCTYPE html>
<html lang="{{ config('app.locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <meta name="description" content="{{ $description ?? 'Welcome to the Dog kennel' }}">
    <title>{{ $title ?? 'The Dog Kennel' }}</title>
</head>
<body class="font-sans antialiased">
<div class="flex flex-col space-y-2 min-h-screen text-gray-800 bg-gray-100">
    <header class="shadow bg-white/70 sticky inset-0 backdrop-blur-sm z-10">
        {{-- Navigation  --}}
        <x-layout.nav/>
    </header>
    <main class="container mx-auto flex-1 px-4">
        {{-- Title --}}
        <h1 class="text-3xl mb-4">
            {{ $subtitle ?? $title ?? "This page has no (sub)title" }}
        </h1>
        {{-- Main content --}}
        {{ $slot }}
    </main>
    <x-layout.footer/>
    @stack('script')
    @livewireScripts
</div>
</body>
</html>
