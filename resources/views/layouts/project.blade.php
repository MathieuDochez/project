<!DOCTYPE html>
<html lang="{{ config('app.locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="description" content="{{ $description ?? 'Welcome to the Project' }}">
    <title>{{ $title ?? 'The Project' }}</title>


</head>
<body class="font-sans antialiased">
<div class="flex flex-col space-y-2 min-h-screen text-gray-800 bg-gray-100">
    <header class="shadow bg-white/70 sticky inset-0 backdrop-blur-sm z-10">
        {{--  Navigation  --}}
{{--        <nav class="container mx-auto p-4 flex justify-between items-center">--}}
{{--            <a href="{{ route('home') }}" class="underline">Home</a>--}}
{{--            <a href="{{ route('contact') }}" class="underline">Contact</a>--}}
{{--            <a href="{{ route('admin.records') }}" class="underline">Records</a>--}}
{{--        </nav>--}}
    </header>
    <main class="container mx-auto flex-1 px-4">
        {{-- Title --}}
        <h1 class="text-3xl mb-4">
            {{ $subtitle ?? $title ?? "This page has no (sub)title" }}

        </h1>
        {{-- Main content --}}
        {{ $slot }}
    </main>
    <footer class="container mx-auto p-4 text-sm border-t flex justify-between items-center">
        <div>The Vinyl Shop - © {{ date('Y') }}</div>
        <div>Build with Laravel {{ app()->version() }}</div>
    </footer>
    @stack('script')
</div>
</body>
</html>
