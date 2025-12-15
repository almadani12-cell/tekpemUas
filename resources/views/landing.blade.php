<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media Pembelajaran Berpikir Komputasional</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Navbar Transparent on Hero */
        nav {
            transition: all 0.3s ease;
        }

        nav.scrolled {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px) !important;
            -webkit-backdrop-filter: blur(20px) !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;
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

        /* Card Hover Effect */
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="antialiased">
    {{-- Navigation --}}
    <nav id="navbar" class="fixed w-full bg-transparent border-b border-transparent z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- Logo --}}
                <div class="flex items-center">
                    <a href="#hero" class="flex items-center gap-2 md:gap-3 smooth-scroll group">
                        <img src="{{ asset('images/logo/logo.png') }}" alt="Co-Think Logo" class="h-8 md:h-10 w-auto transition-transform duration-300 group-hover:scale-105">
                        <span class="font-extrabold text-lg md:text-xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 tracking-wide" style="font-family: 'Plus Jakarta Sans', sans-serif;">Co-Think</span>
                    </a>
                </div>

                {{-- Desktop Navigation --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="#tentang" class="nav-link text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:text-white font-medium transition smooth-scroll">Tentang</a>
                    <a href="#pilar" class="nav-link text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:text-white font-medium transition smooth-scroll">Pilar</a>
                    <a href="#fitur" class="nav-link text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:text-white font-medium transition smooth-scroll">Fitur</a>
                    <a href="#cara-belajar" class="nav-link text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:text-white font-medium transition smooth-scroll">Cara Belajar</a>
                </div>

                {{-- Auth Buttons --}}
                <div class="hidden md:flex items-center gap-3">
                    <a href="{{ route('login') }}" class="nav-link px-4 py-2 text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:text-white font-semibold transition">Masuk</a>
                    <a href="{{ route('register') }}" class="px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:shadow-lg hover:shadow-indigo-500/40 transition-all">Daftar</a>
                </div>

                {{-- Mobile Menu Button --}}
                <button @click="open = !open" class="mobile-toggle md:hidden p-2 rounded-lg hover:bg-white/20 text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            {{-- Mobile Menu --}}
            <div x-show="open" x-transition class="md:hidden pb-4 bg-slate-900/95 backdrop-blur-md -mx-4 px-4 rounded-b-2xl">
                <div class="flex flex-col gap-3">
                    <a href="#tentang" class="text-white hover:text-indigo-300 font-medium smooth-scroll">Tentang</a>
                    <a href="#pilar" class="text-white hover:text-indigo-300 font-medium smooth-scroll">Pilar</a>
                    <a href="#fitur" class="text-white hover:text-indigo-300 font-medium smooth-scroll">Fitur</a>
                    <a href="#cara-belajar" class="text-white hover:text-indigo-300 font-medium smooth-scroll">Cara Belajar</a>
                    <div class="flex gap-2 pt-2">
                        <a href="{{ route('login') }}" class="flex-1 px-4 py-2 text-center border border-slate-300 text-slate-700 font-semibold rounded-lg">Masuk</a>
                        <a href="{{ route('register') }}" class="flex-1 px-4 py-2 text-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-lg">Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section id="hero" class="relative w-full overflow-hidden bg-mesh flex items-center min-h-screen">
        {{-- Blob Shapes --}}
        <div class="blob-shape blob-1"></div>
        <div class="blob-shape blob-2"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full py-32 lg:py-40">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                {{-- Hero Text --}}
                <div class="lg:w-1/2 text-center lg:text-left fade-in-up">
                    <div class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-indigo-100 to-purple-100 border border-indigo-200 mb-6 backdrop-blur-sm hover:shadow-lg transition-shadow">
                        <span class="text-indigo-600 text-sm font-bold tracking-widest">✨ PLATFORM PEMBELAJARAN INTERAKTIF</span>
                    </div>
                    
                    <h1 class="text-5xl lg:text-6xl font-extrabold text-slate-900 leading-tight mb-6 tracking-tight">
                        Kuasai <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600">Berpikir Komputasional</span> untuk Masa Depan Digital
                    </h1>
                    
                    <p class="text-xl text-slate-600 mb-8 leading-relaxed max-w-2xl">
                        Media pembelajaran interaktif untuk siswa SMK Kelas X dalam menguasai konsep berpikir komputasional melalui pendekatan kontekstual yang mudah dipahami.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-bold hover:shadow-xl hover:shadow-indigo-500/40 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Mulai Belajar Gratis
                        </a>
                        <a href="#tentang" class="px-8 py-4 bg-white text-indigo-600 rounded-xl font-bold hover:shadow-lg hover:shadow-slate-200/50 transition-all flex items-center justify-center gap-2 smooth-scroll">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>

                {{-- Hero Illustration --}}
                <div class="lg:w-1/2 fade-in-up delay-200">
                    <div class="relative">
                        <div class="bg-white/70 backdrop-blur-lg rounded-2xl p-8 border border-white/40 shadow-2xl">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-2xl p-6 text-white transform hover:scale-105 transition-transform">
                                    <div class="text-4xl mb-3">🧩</div>
                                    <h3 class="font-bold text-lg">Dekomposisi</h3>
                                    <p class="text-sm text-indigo-100 mt-1">Pecah masalah kompleks</p>
                                </div>
                                <div class="bg-gradient-to-br from-teal-400 to-teal-600 rounded-2xl p-6 text-white transform hover:scale-105 transition-transform">
                                    <div class="text-4xl mb-3">🔍</div>
                                    <h3 class="font-bold text-lg">Pengenalan Pola</h3>
                                    <p class="text-sm text-teal-100 mt-1">Identifikasi pola</p>
                                </div>
                                <div class="bg-gradient-to-br from-amber-400 to-amber-600 rounded-2xl p-6 text-white transform hover:scale-105 transition-transform">
                                    <div class="text-4xl mb-3">💡</div>
                                    <h3 class="font-bold text-lg">Abstraksi</h3>
                                    <p class="text-sm text-amber-100 mt-1">Fokus pada inti</p>
                                </div>
                                <div class="bg-gradient-to-br from-rose-400 to-rose-600 rounded-2xl p-6 text-white transform hover:scale-105 transition-transform">
                                    <div class="text-4xl mb-3">📝</div>
                                    <h3 class="font-bold text-lg">Algoritma</h3>
                                    <p class="text-sm text-rose-100 mt-1">Langkah sistematis</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Tentang Section --}}
    <section id="tentang" class="py-10 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in-up">
                <span class="text-indigo-600 font-bold text-sm uppercase tracking-wider">Tentang Platform</span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mt-3 mb-4">Apa itu Berpikir Komputasional?</h2>
                <p class="text-lg text-slate-600 leading-relaxed">
                    Berpikir komputasional adalah kemampuan untuk memecahkan masalah kompleks dengan pendekatan yang sistematis dan logis, menggunakan konsep dasar ilmu komputer. Keterampilan ini sangat penting di era digital dan menjadi bagian dari Kurikulum Merdeka dalam Mata Pelajaran Informatika.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-8 fade-in-up">
                    <div class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Sesuai Kurikulum</h3>
                    <p class="text-slate-600">Materi disesuaikan dengan Kurikulum Merdeka Informatika untuk SMK Kelas X</p>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-8 fade-in-up delay-100">
                    <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Pendekatan Kontekstual</h3>
                    <p class="text-slate-600">Konsep dijelaskan dengan contoh nyata dari kehidupan sehari-hari siswa</p>
                </div>

                <div class="bg-gradient-to-br from-pink-50 to-indigo-50 rounded-2xl p-8 fade-in-up delay-200">
                    <div class="w-12 h-12 bg-pink-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Interaktif & Menarik</h3>
                    <p class="text-slate-600">Quiz interaktif dan tracking progress untuk motivasi belajar yang lebih baik</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 4 Pilar Section --}}
    <section id="pilar" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in-up">
                <span class="text-indigo-600 font-bold text-sm uppercase tracking-wider">4 Pilar Utama</span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mt-3 mb-4">Pelajari Fondasi Berpikir Komputasional</h2>
                <p class="text-lg text-slate-600">
                    Kuasai keempat pilar fundamental yang membentuk cara berpikir komputasional
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Dekomposisi --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 card-hover fade-in-up">
                    <div class="text-5xl mb-4">🧩</div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Dekomposisi</h3>
                    <p class="text-slate-600 text-sm">Memecah masalah kompleks menjadi bagian-bagian kecil yang lebih mudah dipahami dan diselesaikan</p>
                </div>

                {{-- Pengenalan Pola --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 card-hover fade-in-up delay-100">
                    <div class="text-5xl mb-4">🔍</div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Pengenalan Pola</h3>
                    <p class="text-slate-600 text-sm">Mengidentifikasi pola atau kesamaan dalam masalah untuk menemukan solusi yang efisien</p>
                </div>

                {{-- Abstraksi --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 card-hover fade-in-up delay-200">
                    <div class="text-5xl mb-4">💡</div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Abstraksi</h3>
                    <p class="text-slate-600 text-sm">Menyederhanakan masalah dengan fokus pada informasi penting dan mengabaikan detail yang tidak relevan</p>
                </div>

                {{-- Algoritma --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 card-hover fade-in-up delay-300">
                    <div class="text-5xl mb-4">📝</div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Algoritma</h3>
                    <p class="text-slate-600 text-sm">Menyusun langkah-langkah sistematis dan logis untuk menyelesaikan masalah secara efektif</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Fitur Platform Section --}}
    <section id="fitur" class="py-20  bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in-up">
                <span class="text-indigo-600 font-bold text-sm uppercase tracking-wider">Fitur Platform</span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mt-3 mb-4">Belajar Lebih Efektif & Menyenangkan</h2>
                <p class="text-lg text-slate-600">
                    Platform dilengkapi dengan berbagai fitur untuk mendukung pembelajaran yang optimal
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="flex gap-4 fade-in-up">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Materi Teks & Video</h3>
                        <p class="text-slate-600">Materi pembelajaran lengkap dalam format teks dan video untuk berbagai gaya belajar</p>
                    </div>
                </div>

                <div class="flex gap-4 fade-in-up delay-100">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Quiz Interaktif 3 Level</h3>
                        <p class="text-slate-600">Setiap pilar memiliki 3 level quiz dengan tingkat kesulitan bertahap untuk mengukur pemahaman</p>
                    </div>
                </div>

                <div class="flex gap-4 fade-in-up delay-200">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Tracking Progress Real-time</h3>
                        <p class="text-slate-600">Pantau perkembangan belajar Anda dengan dashboard progress yang informatif dan real-time</p>
                    </div>
                </div>

                <div class="flex gap-4 fade-in-up delay-300">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Sistem Badge & Achievement</h3>
                        <p class="text-slate-600">Dapatkan badge dan unlock level baru saat mencapai skor minimal untuk motivasi belajar</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Cara Belajar Section --}}
    <section id="cara-belajar" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in-up">
                <span class="text-indigo-600 font-bold text-sm uppercase tracking-wider">Cara Belajar</span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mt-3 mb-4">Mulai Belajar dalam 3 Langkah Mudah</h2>
                <p class="text-lg text-slate-600">
                    Proses pembelajaran yang sederhana dan terstruktur
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="relative fade-in-up">
                    <div class="bg-white rounded-2xl border border-slate-200 p-8 text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white text-2xl font-bold">1</div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Daftar & Login</h3>
                        <p class="text-slate-600">Buat akun gratis dan login untuk mengakses semua fitur pembelajaran</p>
                    </div>
                    <div class="hidden md:block absolute top-1/2 -right-4 transform -translate-y-1/2 z-10">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </div>
                </div>

                <div class="relative fade-in-up delay-100">
                    <div class="bg-white rounded-2xl border border-slate-200 p-8 text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-600 to-pink-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white text-2xl font-bold">2</div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Pilih Pilar & Belajar</h3>
                        <p class="text-slate-600">Pilih salah satu dari 4 pilar dan pelajari materi melalui teks atau video</p>
                    </div>
                    <div class="hidden md:block absolute top-1/2 -right-4 transform -translate-y-1/2 z-10">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </div>
                </div>

                <div class="fade-in-up delay-200">
                    <div class="bg-white rounded-2xl border border-slate-200 p-8 text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-pink-600 to-rose-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white text-2xl font-bold">3</div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Quiz & Unlock Level</h3>
                        <p class="text-slate-600">Kerjakan quiz dan dapatkan skor minimal 80% untuk unlock level berikutnya</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="py-20 bg-slate-50">
        <div class="text-center max-w-3xl mx-auto mb-16 fade-in-up">
            <span class="text-indigo-600 font-bold text-sm uppercase tracking-wider">Statistik Evaluasi</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mt-3 mb-4">Platform Lengkap untuk Pembelajaran Optimal</h2>
            <p class="text-lg text-slate-600">
                Konten pembelajaran yang terstruktur dengan sistem evaluasi bertingkat untuk mengukur pemahamanmu
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 max-w-3xl mx-auto px-8 py-8 sm:px-6 lg:px-15 lg:py-12 shadow-lg fade-in-up">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center fade-in-up">
                    <div class="text-4xl md:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 mb-2">4</div>
                    <div class="text-slate-600 font-medium">Pilar Pembelajaran</div>
                </div>
                <div class="text-center fade-in-up delay-100">
                    <div class="text-4xl md:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 mb-2">12</div>
                    <div class="text-slate-600 font-medium">Quiz Interaktif</div>
                </div>
                <div class="text-center fade-in-up delay-200">
                    <div class="text-4xl md:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-rose-600 mb-2">96</div>
                    <div class="text-slate-600 font-medium">Soal Berkualitas</div>
                </div>
                <div class="text-center fade-in-up delay-300">
                    <div class="text-4xl md:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-indigo-600 mb-2">100%</div>
                    <div class="text-slate-600 font-medium">Gratis</div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-16 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-600/20 rounded-full blur-3xl"></div>

        <div class="max-w-4xl mx-auto px-4 text-center relative z-10 fade-in-up">
            <h2 class="text-3xl lg:text-4xl font-extrabold mb-4 tracking-tight">Siap Mengasah Kemampuan Berpikir Komputasional?</h2>
            <p class="text-lg text-indigo-100 mb-8 max-w-2xl mx-auto">
                Bergabunglah sekarang dan mulai perjalanan belajar Anda dengan platform pembelajaran interaktif
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="px-8 py-4 bg-amber-500 text-slate-900 rounded-full font-bold hover:bg-amber-400 transition-colors shadow-lg shadow-amber-500/20">
                    Daftar Sekarang - Gratis
                </a>
                <a href="{{ route('login') }}" class="px-8 py-4 bg-slate-800 border border-slate-700 text-white rounded-full font-bold hover:bg-slate-700 transition-colors">
                    Sudah Punya Akun? Masuk
                </a>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-white mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-2 md:gap-3">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Co-Think Logo" class="h-8 md:h-10 w-auto opacity-90">
                    <div>
                        <span class="font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-base md:text-lg block tracking-wide" style="font-family: 'Plus Jakarta Sans', sans-serif;">Co-Think</span>
                        <span class="text-xs text-slate-500 hidden sm:block">Platform Pembelajaran</span>
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

    {{-- Scripts --}}
    <script>
        // Smooth Scroll
        document.querySelectorAll('.smooth-scroll').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId.startsWith('#')) {
                    const target = document.querySelector(targetId);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });

        // Navbar Scroll Effect
        const navbar = document.getElementById('navbar');
        const navLinks = document.querySelectorAll('.nav-link');
        const mobileToggle = document.querySelector('.mobile-toggle');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
                navbar.classList.remove('bg-transparent', 'border-transparent');
                navbar.classList.add('bg-white/95', 'border-slate-200');
                
                // Change nav links to dark color
                navLinks.forEach(link => {
                    link.classList.remove('text-white', 'hover:text-indigo-300', 'text-transparent', 'bg-clip-text', 'bg-gradient-to-r', 'from-indigo-600', 'via-purple-600', 'to-pink-600', 'hover:text-white');
                    link.classList.add('text-slate-700', 'hover:text-indigo-600');
                });
                
                // Change mobile toggle color
                if (mobileToggle) {
                    mobileToggle.classList.remove('text-white', 'hover:bg-white/20');
                    mobileToggle.classList.add('text-slate-700', 'hover:bg-slate-100');
                }
            } else {
                navbar.classList.remove('scrolled', 'bg-white/95', 'border-slate-200');
                navbar.classList.add('bg-transparent', 'border-transparent');
                
                // Change nav links back to gradient
                navLinks.forEach(link => {
                    link.classList.remove('text-slate-700', 'hover:text-indigo-600');
                    link.classList.add('text-transparent', 'bg-clip-text', 'bg-gradient-to-r', 'from-indigo-600', 'via-purple-600', 'to-pink-600', 'hover:text-white');
                });
                
                // Change mobile toggle back to white
                if (mobileToggle) {
                    mobileToggle.classList.remove('text-slate-700', 'hover:bg-slate-100');
                    mobileToggle.classList.add('text-white', 'hover:bg-white/20');
                }
            }
        });
    </script>
</body>
</html>
