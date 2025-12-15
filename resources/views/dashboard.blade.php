<x-learning-layout>
    @php $title = 'Dashboard'; @endphp

    {{-- ======================== HERO SECTION ======================== --}}
    <section class="relative w-full  py-0 lg:py-0 overflow-hidden bg-mesh flex items-center">
        {{-- Blob Shapes --}}
        <div class="blob-shape blob-1"></div>
        <div class="blob-shape blob-2"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full py-32 lg:py-40">
            {{-- White Card Wrapper --}}
            <div class="bg-white rounded-3xl shadow-2xl p-10">
                <div class="flex flex-col items-center">
                    {{-- Hero Text --}}
                    <div class="text-center fade-in-up">
                        <div class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-indigo-100 to-purple-100 border border-indigo-200 mb-6 backdrop-blur-sm hover:shadow-lg transition-shadow">
                            <span class="text-indigo-600 text-sm font-bold tracking-widest">👋 SELAMAT DATANG KEMBALI</span>
                        </div>
                        
                        <h1 class="text-5xl lg:text-6xl font-extrabold text-slate-900 leading-tight mb-6 tracking-tight">
                            Halo, <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600">{{ Auth::user()->name }}</span>! 👨‍💻
                        </h1>
                        
                        <p class="text-xl text-slate-600 mb-8 leading-relaxed max-w-2xl mx-auto">
                            Lanjutkan perjalanan belajarmu dalam menguasai berpikir komputasional. Kamu sudah menyelesaikan <strong class="text-indigo-600">{{ $questionsCompleted }} soal</strong> dan menguasai <strong class="text-purple-600">{{ $quizzesMastered }} quiz</strong>. Pertahankan progressmu!
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('materi.index') }}" class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-bold hover:shadow-xl hover:shadow-indigo-500/40 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                Mulai Belajar
                            </a>
                            <a href="{{ route('evaluasi.index') }}" class="px-8 py-4 bg-gradient-to-r from-slate-100 to-slate-50 text-indigo-600 rounded-xl font-bold hover:shadow-lg hover:shadow-slate-200/50 transition-all flex items-center justify-center gap-2 border border-slate-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                                Ujian Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ======================== STATS BANNER ======================== --}}
    <section class="max-w-6xl mx-auto px-4 -mt-8 relative z-20 fade-in-up delay-300">
        <div class="text-center mb-12 fade-in-up">
            <h2 class="text-indigo-600 font-bold tracking-wide uppercase mb-2">Statistik Evaluasimu</h2>
            <h3 class="text-3xl md:text-4xl font-extrabold text-slate-900">Optimalkan Terus Progres Belajarmu</h3>
            <p class="text-slate-600 mt-4 max-w-2xl mx-auto">
                Pantau perkembangan kemampuan berpikir komputasionalmu melalui statistik lengkap berikut
            </p>
        </div>
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <p class="text-4xl font-extrabold text-indigo-600 mb-1">{{ $totalQuizzes }}</p>
                <p class="text-sm font-semibold text-slate-500">Total Quiz</p>
            </div>
            <div class="text-center border-l border-slate-100 pl-4">
                <p class="text-4xl font-extrabold text-teal-600 mb-1">{{ $totalQuestions }}</p>
                <p class="text-sm font-semibold text-slate-500">Total Soal Quiz</p>
            </div>
            <div class="text-center border-l border-slate-100 pl-4">
                <p class="text-4xl font-extrabold text-amber-600 mb-1">{{ $quizzesMastered }}</p>
                <p class="text-sm font-semibold text-slate-500">Quiz Dikuasai</p>
            </div>
            <div class="text-center border-l border-slate-100 pl-4">
                <p class="text-4xl font-extrabold text-rose-600 mb-1">{{ $questionsCompleted }}</p>
                <p class="text-sm font-semibold text-slate-500">Soal Diselesaikan</p>
            </div>
        </div>
    </section>

    {{-- ======================== QUICK ACTIONS SECTION ======================== --}}
    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 fade-in-up">
                <h2 class="text-indigo-600 font-bold tracking-wide uppercase mb-2">Aksi Cepat</h2>
                <h3 class="text-3xl md:text-4xl font-extrabold text-slate-900">Lanjutkan Pembelajaran</h3>
                <p class="text-slate-600 mt-4 max-w-2xl mx-auto">
                    Lihat progress belajarmu di setiap pilar dan lanjutkan ke level berikutnya
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($pillars as $index => $pillar)
                    @php
                        $user = Auth::user();
                        $progress = $user->quizProgress()->where('pillar_id', $pillar->id)->first();
                        
                        // Calculate completed levels (score >= 80%)
                        $completedLevels = 0;
                        $nextLevel = 1;
                        
                        if ($progress) {
                            if ($progress->best_score_level_1 >= 80) $completedLevels++;
                            if ($progress->best_score_level_2 >= 80) $completedLevels++;
                            if ($progress->best_score_level_3 >= 80) $completedLevels++;
                            
                            // Determine next level
                            if ($progress->best_score_level_1 < 80) {
                                $nextLevel = 1;
                            } elseif ($progress->best_score_level_2 < 80) {
                                $nextLevel = 2;
                            } elseif ($progress->best_score_level_3 < 80) {
                                $nextLevel = 3;
                            } else {
                                $nextLevel = 3; // All completed, show level 3
                            }
                        }
                        
                        // Calculate progress percentage
                        $progressPercentage = ($completedLevels / 3) * 100;
                        
                        // Color classes
                        $colorClasses = [
                            'indigo' => [
                                'border' => 'border-indigo-200',
                                'bg' => 'bg-indigo-50',
                                'text' => 'text-indigo-600',
                                'progress' => 'bg-indigo-600',
                                'button' => 'from-indigo-600 to-indigo-700',
                            ],
                            'teal' => [
                                'border' => 'border-teal-200',
                                'bg' => 'bg-teal-50',
                                'text' => 'text-teal-600',
                                'progress' => 'bg-teal-600',
                                'button' => 'from-teal-600 to-teal-700',
                            ],
                            'amber' => [
                                'border' => 'border-amber-200',
                                'bg' => 'bg-amber-50',
                                'text' => 'text-amber-600',
                                'progress' => 'bg-amber-600',
                                'button' => 'from-amber-600 to-amber-700',
                            ],
                            'rose' => [
                                'border' => 'border-rose-200',
                                'bg' => 'bg-rose-50',
                                'text' => 'text-rose-600',
                                'progress' => 'bg-rose-600',
                                'button' => 'from-rose-600 to-rose-700',
                            ],
                        ];
                        
                        $colors = $colorClasses[$pillar->color] ?? $colorClasses['indigo'];
                        
                        // CTA text and route
                        $ctaText = $completedLevels > 0 ? "Lanjutkan ke Level {$nextLevel}" : "Mulai Quiz Sekarang";
                    @endphp
                    
                    <div class="bg-white rounded-2xl border-2 {{ $colors['border'] }} p-6 card-hover fade-in-up delay-{{ ($index + 1) * 100 }}">
                        {{-- Icon and Title --}}
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 {{ $colors['bg'] }} rounded-xl flex items-center justify-center text-2xl">
                                @switch($index)
                                    @case(0)
                                        🧩
                                        @break
                                    @case(1)
                                        🔍
                                        @break
                                    @case(2)
                                        💡
                                        @break
                                    @case(3)
                                        📝
                                        @break
                                @endswitch
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900">{{ $pillar->name }}</h4>
                                <p class="text-xs text-slate-500">{{ $completedLevels }}/3 Level Selesai</p>
                            </div>
                        </div>
                        
                        {{-- Progress Bar --}}
                        <div class="mb-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-slate-600">Progress</span>
                                <span class="text-sm font-bold {{ $colors['text'] }}">{{ round($progressPercentage) }}%</span>
                            </div>
                            <div class="w-full bg-slate-200 rounded-full h-3 overflow-hidden">
                                <div class="{{ $colors['progress'] }} h-full rounded-full transition-all duration-500" style="width: {{ $progressPercentage }}%"></div>
                            </div>
                        </div>
                        
                        {{-- CTA Button --}}
                        <a href="{{ route('evaluasi.start-level', ['pillar' => $pillar->slug, 'level' => $nextLevel]) }}" class="block w-full py-3 bg-gradient-to-r {{ $colors['button'] }} text-white rounded-xl font-bold text-center hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                            {{ $ctaText }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ======================== PILLARS MATERI SECTION ======================== --}}
    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 fade-in-up">
                <h2 class="text-indigo-600 font-bold tracking-wide uppercase mb-2">4 Pilar Utama</h2>
                <h3 class="text-3xl md:text-4xl font-extrabold text-slate-900">Berpikir Komputasional</h3>
                <p class="text-slate-600 mt-4 max-w-2xl mx-auto">
                    Pelajari empat pilar fundamental yang akan membantu kamu memecahkan masalah secara sistematis dan efisien.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($pillars as $index => $pillar)
                    <div class="fade-in-up delay-{{ ($index + 1) * 100 }}">
                        <x-pillar-card :pillar="$pillar">
                            <div class="mt-4 pt-4 border-t border-slate-100">
                                <a href="{{ route('materi.show', ['pillar' => $pillar->slug, 'type' => 'text']) }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-600">
                                    Mulai Belajar
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </x-pillar-card>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ======================== RECENT ACTIVITY ======================== --}}
    @if($recentAttempts->isNotEmpty())
        <section class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">Aktivitas Terakhir</h2>
                        <p class="text-slate-600 mt-1">Quiz yang baru saja kamu selesaikan</p>
                    </div>
                    <a href="{{ route('performa.index') }}" class="inline-flex items-center px-4 py-2 border border-slate-200 rounded-lg text-sm font-medium text-slate-600 hover:border-indigo-300 hover:text-indigo-600 transition-colors">
                        Lihat Semua Performa
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($recentAttempts as $attempt)
                        @php
                            $pillar = $attempt->quiz->pillar;
                            $colorClasses = [
                                'indigo' => 'border-l-indigo-500 bg-indigo-50',
                                'teal' => 'border-l-teal-500 bg-teal-50',
                                'amber' => 'border-l-amber-500 bg-amber-50',
                                'rose' => 'border-l-rose-500 bg-rose-50',
                            ];
                            $color = $colorClasses[$pillar->color] ?? 'border-l-indigo-500 bg-indigo-50';
                        @endphp
                        <div class="bg-white rounded-xl border border-slate-200 border-l-4 {{ $color }} p-5 card-hover">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xs font-medium text-slate-500">{{ $attempt->completed_at->diffForHumans() }}</span>
                                <span class="px-2 py-1 rounded-full text-xs font-bold {{ $attempt->score >= 70 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $attempt->score }}%
                                </span>
                            </div>
                            <h4 class="font-bold text-slate-900 mb-1">{{ $pillar->name }}</h4>
                            <p class="text-sm text-slate-600">{{ $attempt->correct_answers }}/{{ $attempt->total_questions }} jawaban benar</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

</x-learning-layout>
