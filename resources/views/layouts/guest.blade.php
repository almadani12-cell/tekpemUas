<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Co-Think') }} - Platform Pembelajaran Berpikir Komputasional</title>
        <meta name="description" content="Login ke Co-Think - Platform pembelajaran berpikir komputasional untuk siswa SMK.">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 relative overflow-hidden">
            {{-- Background Pattern --}}
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10"></div>
            
            <div class="mb-8 fade-in-scale relative z-10">
                <a href="/" class="flex flex-col items-center gap-3">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Co-Think Logo" class="h-20 sm:h-24 md:h-28 w-auto drop-shadow-lg">
                    <div class="text-center">
                        <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 tracking-wider" style="font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: 0.02em;">Co-Think</h1>
                        <p class="text-xs sm:text-sm text-slate-600 mt-1 px-4">Platform Pembelajaran Berpikir Komputasional</p>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-6 py-8 bg-white/95 backdrop-blur-sm shadow-2xl overflow-hidden sm:rounded-3xl border-2 border-slate-200 relative z-10">
                {{ $slot }}
            </div>
            
            {{-- Footer --}}
            <div class="mt-8 text-center text-sm text-slate-600 relative z-10">
                <p>&copy; 2024 Co-Think. Platform Pembelajaran SMK.</p>
            </div>
        </div>
        
        <style>
            @keyframes fadeInScale {
                from {
                    opacity: 0;
                    transform: scale(0.9);
                }
                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }
            .fade-in-scale {
                animation: fadeInScale 0.6s ease-out;
            }
        </style>
    </body>
</html>
