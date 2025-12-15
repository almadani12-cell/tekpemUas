<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Dashboard' }} - Co-Think | Platform Pembelajaran Berpikir Komputasional</title>
    <meta name="description" content="Platform pembelajaran berpikir komputasional interaktif untuk siswa SMK Kelas X. Pelajari dekomposisi, pengenalan pola, abstraksi, dan algoritma.">
    <meta name="keywords" content="berpikir komputasional, pembelajaran, SMK, dekomposisi, algoritma, abstraksi, pengenalan pola">
    
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Scripts & Tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    {{-- Sortable.js for Drag & Drop --}}
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <style>
        /* Typography Modern */
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Custom CSS Variables */
        :root {
            --primary: #4338ca;
            --secondary: #0f172a;
            --accent: #f59e0b;
        }

        /* Navbar Transparent on Hero */
        nav {
            background: transparent !important;
            border-bottom: none !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
            transition: all 0.3s ease;
        }

        nav.scrolled {
            background: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(20px) !important;
            -webkit-backdrop-filter: blur(20px) !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;
        }

        nav.scrolled a,
        nav.scrolled button,
        nav.scrolled span:not(.text-indigo-600):not(.logo-text) {
            color: #1e293b !important;
        }

        nav.scrolled .text-slate-600,
        nav.scrolled .text-slate-700 {
            color: #475569 !important;
        }

        /* Glassmorphism Classes */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .glass-dark {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* Mesh Gradient Background */
        .bg-mesh {
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, hsla(239, 84%, 67%, 0.15) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(283, 89%, 66%, 0.12) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(330, 81%, 60%, 0.15) 0, transparent 50%);
            position: relative;
        }

        /* Blob Shape Animation */
        .blob-shape {
            position: absolute;
            border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
            animation: morph 8s linear infinite;
            opacity: 0.3;
        }

        .blob-1 {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            top: -100px;
            left: -50px;
            mix-blend-mode: screen;
        }

        .blob-2 {
            width: 350px;
            height: 350px;
            background: linear-gradient(135deg, #ec4899, #f43f5e);
            bottom: -100px;
            right: -50px;
            mix-blend-mode: screen;
            animation: morph 8s linear infinite reverse;
        }

        @keyframes morph {
            0%, 100% { border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%; }
            34% { border-radius: 70% 30% 50% 50% / 30% 30% 70% 70%; }
            67% { border-radius: 100% 60% 60% 100% / 100% 100% 60% 60%; }
        }

        /* Animations */
        .fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease-out forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up.delay-100 { animation-delay: 0.1s; }
        .fade-in-up.delay-200 { animation-delay: 0.2s; }
        .fade-in-up.delay-300 { animation-delay: 0.3s; }
        .fade-in-up.delay-400 { animation-delay: 0.4s; }

        /* Hover Card Effect */
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #d946ef 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Pillar Colors */
        .pillar-indigo { --pillar-color: #6366f1; --pillar-light: #e0e7ff; }
        .pillar-teal { --pillar-color: #14b8a6; --pillar-light: #ccfbf1; }
        .pillar-amber { --pillar-color: #f59e0b; --pillar-light: #fef3c7; }
        .pillar-rose { --pillar-color: #f43f5e; --pillar-light: #ffe4e6; }

        /* Drag Drop Styles */
        .sortable-ghost {
            opacity: 0.4;
            background: #e0e7ff;
        }
        .sortable-chosen {
            background: #c7d2fe;
        }
        .sortable-drag {
            opacity: 0.9;
        }

        /* Quiz Option Styles */
        .quiz-option {
            transition: all 0.2s ease;
        }
        .quiz-option:hover {
            border-color: #6366f1;
            background: #f5f3ff;
        }
        .quiz-option.selected {
            border-color: #6366f1;
            background: #e0e7ff;
        }

        /* Progress Bar Animation */
        .progress-bar {
            transition: width 0.5s ease;
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Alpine.js x-cloak */
        [x-cloak] {
            display: none !important;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-indigo-500 selection:text-white min-h-screen flex flex-col">

    {{-- ======================== LOADING SCREEN ======================== --}}
    <x-loading-screen />

    {{-- ======================== NAVBAR ======================== --}}
    <nav class="fixed w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- Logo --}}
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 md:gap-3 group">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Co-Think Logo" class="h-8 md:h-10 w-auto transition-transform duration-300 group-hover:scale-105">
                    <span class="logo-text hidden md:inline-block text-xl lg:text-2xl font-extrabold tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 transition-colors" style="font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: 0.02em;">Co-Think</span>
                </a>

                {{-- Desktop Navigation --}}
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('dashboard') }}" class="nav-link px-4 py-2 rounded-lg text-sm font-medium transition-colors text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:text-white {{ request()->routeIs('dashboard') ? 'bg-white/10' : '' }}">
                        <svg class="w-4 h-4 inline-block mr-1.5 -mt-0.5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard
                    </a>
                    
                    <a href="{{ route('materi.index') }}" class="nav-link px-4 py-2 rounded-lg text-sm font-medium transition-colors text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:text-white {{ request()->routeIs('materi.*') ? 'bg-white/10' : '' }}">
                        <svg class="w-4 h-4 inline-block mr-1.5 -mt-0.5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Materi
                    </a>
                    
                    <a href="{{ route('evaluasi.index') }}" class="nav-link px-4 py-2 rounded-lg text-sm font-medium transition-colors text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:text-white {{ request()->routeIs('evaluasi.*') ? 'bg-white/10' : '' }}">
                        <svg class="w-4 h-4 inline-block mr-1.5 -mt-0.5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                        Evaluasi
                    </a>
                    
                    <a href="{{ route('performa.index') }}" class="nav-link px-4 py-2 rounded-lg text-sm font-medium transition-colors text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:text-white {{ request()->routeIs('performa.*') ? 'bg-white/10' : '' }}">
                        <svg class="w-4 h-4 inline-block mr-1.5 -mt-0.5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Performa
                    </a>

                    {{-- Dropdown Lainnya --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="nav-link px-4 py-2 rounded-lg text-sm font-medium text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:text-white transition-colors flex items-center {{ request()->routeIs('pages.*') ? 'bg-white/10' : '' }}">
                            <svg class="w-4 h-4 inline-block mr-1.5 -mt-0.5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                            </svg>
                            Lainnya
                            <svg class="w-4 h-4 ml-1 transition-transform text-indigo-600" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute left-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50" style="display: none;">
                            <a href="{{ route('pages.tim-pengembang') }}" class="block px-4 py-2 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600">
                                <svg class="w-4 h-4 inline-block mr-2 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Tim Pengembang
                            </a>
                            <a href="{{ route('pages.sumber') }}" class="block px-4 py-2 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600">
                                <svg class="w-4 h-4 inline-block mr-2 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                </svg>
                                Sumber Referensi
                            </a>
                        </div>
                    </div>
                </div>

                {{-- User Menu --}}
                <div class="flex items-center space-x-4">
                    {{-- User Dropdown --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center space-x-2 px-3 py-1.5 rounded-full bg-white/50 hover:bg-white/30 transition-colors">
                            <div class="w-8 h-8 bg-gradient-to-br from-indigo-400 to-purple-500 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="user-name text-sm font-medium text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hidden sm:block">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-white/70 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50" style="display: none;">
                            <div class="px-4 py-3 border-b border-slate-100">
                                <p class="text-sm font-semibold text-slate-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600">
                                <svg class="w-4 h-4 inline-block mr-2 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profil Saya
                            </a>
                            <a href="{{ route('performa.index') }}" class="block px-4 py-2 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600">
                                <svg class="w-4 h-4 inline-block mr-2 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                Lihat Performa
                            </a>
                            <div class="border-t border-slate-100 mt-2 pt-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <svg class="w-4 h-4 inline-block mr-2 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Mobile Menu Toggle --}}
                    <button id="mobile-toggle" class="md:hidden p-2 rounded-lg text-white hover:bg-white/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="md:hidden fixed inset-0 bg-slate-900/95 z-40 transform translate-x-full transition-transform duration-300 flex flex-col pt-20 px-6" style="top: 0;">
            <button id="close-menu" class="absolute top-5 right-5 p-2 text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <a href="{{ route('dashboard') }}" class="block py-3 text-lg font-semibold text-white hover:text-indigo-400">Dashboard</a>
            <a href="{{ route('materi.index') }}" class="block py-3 text-lg font-semibold text-white hover:text-indigo-400">Materi</a>
            <a href="{{ route('evaluasi.index') }}" class="block py-3 text-lg font-semibold text-white hover:text-indigo-400">Evaluasi</a>
            <a href="{{ route('performa.index') }}" class="block py-3 text-lg font-semibold text-white hover:text-indigo-400">Performa</a>
            <a href="{{ route('pages.tim-pengembang') }}" class="block py-3 text-lg font-semibold text-white hover:text-indigo-400">Tim Pengembang</a>
            <a href="{{ route('pages.sumber') }}" class="block py-3 text-lg font-semibold text-white hover:text-indigo-400">Sumber</a>
            <hr class="my-4 border-slate-700">
            <a href="{{ route('profile.edit') }}" class="block py-3 text-lg font-semibold text-white hover:text-indigo-400">Profil</a>
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="w-full py-3 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700">Keluar</button>
            </form>
        </div>
    </nav>

    {{-- ======================== MAIN CONTENT ======================== --}}
    <main class="flex-1 w-full">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center" role="alert">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center" role="alert">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        {{ $slot }}
    </main>

    {{-- ======================== FOOTER ======================== --}}
    <footer class="bg-white border-t border-slate-200 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-2 md:gap-3">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Co-Think Logo" class="h-8 md:h-10 w-auto opacity-90">
                    <div>
                        <span class="font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-base md:text-lg block tracking-wide" style="font-family: 'Plus Jakarta Sans', sans-serif;">Co-Think</span>
                        <span class="text-xs text-slate-500 hidden sm:block">Platform Pembelajaran Berpikir Komputasional</span>
                    </div>
                </div>
                <p class="text-sm text-slate-600 text-center">
                    Media Pembelajaran Berpikir Komputasional untuk Siswa SMK Kelas X
                </p>
                <p class="text-sm text-slate-500">
                    &copy; {{ date('Y') }} All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    {{-- ======================== SCRIPTS ======================== --}}
    <script>
        // Navbar Scroll Effect
        const navbar = document.querySelector('nav');
        const navLinks = document.querySelectorAll('.nav-link');
        const userName = document.querySelector('.user-name');
        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.scrollY;
            
            if (currentScroll > 50) {
                navbar.classList.add('scrolled');
                // Change nav links to dark color when scrolled
                navLinks.forEach(link => {
                    link.classList.remove('text-transparent', 'bg-clip-text', 'bg-gradient-to-r', 'from-indigo-600', 'via-purple-600', 'to-pink-600', 'hover:text-white');
                    link.classList.add('text-slate-700', 'hover:text-indigo-600');
                });
                // Change user name to dark color
                if (userName) {
                    userName.classList.remove('text-transparent', 'bg-clip-text', 'bg-gradient-to-r', 'from-indigo-600', 'via-purple-600', 'to-pink-600');
                    userName.classList.add('text-slate-700');
                }
            } else {
                navbar.classList.remove('scrolled');
                // Change nav links back to gradient when not scrolled
                navLinks.forEach(link => {
                    link.classList.remove('text-slate-700', 'hover:text-indigo-600');
                    link.classList.add('text-transparent', 'bg-clip-text', 'bg-gradient-to-r', 'from-indigo-600', 'via-purple-600', 'to-pink-600', 'hover:text-white');
                });
                // Change user name back to gradient
                if (userName) {
                    userName.classList.remove('text-slate-700');
                    userName.classList.add('text-transparent', 'bg-clip-text', 'bg-gradient-to-r', 'from-indigo-600', 'via-purple-600', 'to-pink-600');
                }
            }
            
            lastScroll = currentScroll;
        });

        // Mobile Menu Toggle
        const mobileToggle = document.getElementById('mobile-toggle');
        const closeMenu = document.getElementById('close-menu');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileToggle && closeMenu && mobileMenu) {
            mobileToggle.addEventListener('click', () => {
                mobileMenu.classList.remove('translate-x-full');
            });

            closeMenu.addEventListener('click', () => {
                mobileMenu.classList.add('translate-x-full');
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
