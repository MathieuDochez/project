<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
</head>
<body class="font-sans antialiased">
<div class="bg-gray-100 flex flex-col min-h-screen align-middle	h-screen">
    <header class="shadow bg-white/70 sm:sticky sm:inset-0 sm:backdrop-blur-sm z-10">
        <x-layout.nav/>
    </header>
    <div class="flex m-auto flex-col items-center justify-center h-full">
        <div class="text-center">
            @hasSection ('code')
                <h1 class="text-9xl font-semibold text-orange-600 mb-4 flex-1">
                    @yield('code')
                </h1>
            @endif
            @hasSection('subtitle')
                <h3 class="text-xl font-semibold mb-2 flex-1">
                    @yield('subtitle')
                </h3>
            @endif
            @hasSection('message')
                <p class="text-lg my-auto text-gray-700 flex-1">
                    @yield('message')
                </p>
            @endif
            @hasSection('content')
                @yield('content')
            @else
                <div class="flex justify-evenly">
                    <a href="/" wire:navigate>
                        <x-button type="button" class="py-3 px-6 mt-5" color="orange">
                            Back
                        </x-button>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@stack('modals')
<script>
    document.querySelector("body > div > header > nav > div > div").remove();

    let link = document.createElement("a");
    link.href = "{{ route('home') }}";
    link.innerText = "Home";
    document.querySelector("body > div > header > nav > div").appendChild(link);
</script>
</body>
</html>
