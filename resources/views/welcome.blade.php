<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white w-full">

            {{-- Navbar tetap di atas --}}
            <nav class="absolute top-0 w-full p-4">
                @if (Route::has('login'))
                    <livewire:welcome.navigation />
                @endif
            </nav>

            <main class="flex flex-col items-center justify-center flex-1 w-full">
                <div class="flex flex-col p-6 mx-auto max-w-7xl lg:p-8 space-y-4 items-center">
                    <x-application-logo class="w-24 h-24 fill-current text-primary" />
                    <x-button indigo xl href="{{ route('register') }}">Get Started</x-button>
                </div>
            </main>

        </div>
    </div>
</body>


</html>
