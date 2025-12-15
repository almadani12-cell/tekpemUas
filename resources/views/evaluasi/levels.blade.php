<x-learning-layout>
    @php 
        $title = 'Pilih Level Quiz ' . $pillar->name;
        
        $colorClasses = [
            'indigo' => ['gradient' => 'from-indigo-600 to-indigo-800', 'bg' => 'bg-indigo-600', 'text' => 'text-indigo-600', 'border' => 'border-indigo-200'],
            'teal' => ['gradient' => 'from-teal-600 to-teal-800', 'bg' => 'bg-teal-600', 'text' => 'text-teal-600', 'border' => 'border-teal-200'],
            'amber' => ['gradient' => 'from-amber-600 to-amber-800', 'bg' => 'bg-amber-600', 'text' => 'text-amber-600', 'border' => 'border-amber-200'],
            'rose' => ['gradient' => 'from-rose-600 to-rose-800', 'bg' => 'bg-rose-600', 'text' => 'text-rose-600', 'border' => 'border-rose-200'],
        ];
        $color = $colorClasses[$pillar->color] ?? $colorClasses['indigo'];
    @endphp

    {{-- Hero Section --}}
    <x-page-hero 
        :title="'Quiz ' . $pillar->name"
        titleHighlight="Pilih Level"
        badge="📊 LEVEL SYSTEM"
        description="Mulai dari Level 1 dan unlock level berikutnya dengan score minimal 80%"
        :breadcrumb="[
            ['name' => 'Dashboard', 'url' => route('dashboard')],
            ['name' => 'Evaluasi', 'url' => route('evaluasi.index')],
            ['name' => 'Quiz ' . $pillar->name]
        ]"
    />
    {{-- Tutorial Modal --}}
    <div x-data="{ showTutorial: true }" x-cloak>
        {{-- Modal Backdrop --}}
        <div x-show="showTutorial" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            {{-- Modal Content --}}
            <div x-show="showTutorial" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="bg-white rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden">
                {{-- Modal Header --}}
                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-6 text-white">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold">Petunjuk Quiz</h2>
                            <p class="text-white/80 text-sm">Baca dengan seksama sebelum memulai</p>
                        </div>
                    </div>
                </div>
                
                {{-- Modal Body --}}
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <span class="text-indigo-600 font-bold">1</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900">Dua Tipe Soal</h4>
                                <p class="text-sm text-slate-600">Quiz terdiri dari soal <strong>Pilihan Ganda</strong> dan <strong>Drag & Drop</strong> (mengurutkan).</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <span class="text-indigo-600 font-bold">2</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900">Feedback Langsung</h4>
                                <p class="text-sm text-slate-600">Setelah menjawab setiap soal, kamu akan melihat apakah jawabanmu benar atau salah beserta penjelasannya.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <span class="text-indigo-600 font-bold">3</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900">Total 8 Soal per Level</h4>
                                <p class="text-sm text-slate-600">Setiap level memiliki 8 soal dengan kombinasi pilihan ganda dan drag & drop.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <span class="text-purple-600 font-bold">4</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900">3 Level Bertingkat</h4>
                                <p class="text-sm text-slate-600">Setiap pilar memiliki 3 level. Kamu bisa retake berkali-kali, <strong>hanya nilai terbaik yang disimpan per level</strong>.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900">Tidak Bisa Mengulang Jawaban</h4>
                                <p class="text-sm text-slate-600">Jawaban yang sudah disubmit tidak dapat diubah. Pastikan jawabanmu sudah benar.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Modal Footer --}}
                <div class="p-6 bg-white border-t border-slate-100">
                    <button @click="showTutorial = false" class="w-full py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold rounded-xl hover:opacity-90 transition-opacity">
                        Mengerti, Pilih Level
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- Content --}}
    <section class="py-12 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-6">
                @for($level = 1; $level <= 3; $level++)
                    @php
                        $isUnlocked = $progress->isLevelUnlocked($level);
                        $isAvailable = in_array($level, $availableLevels);
                        $bestScore = $progress->getBestScore($level);
                        $maxPoints = 8 * $level; // 8 soal * poin per level
                    @endphp

                    <div class="bg-white rounded-2xl border-2 {{ $isUnlocked ? $color['border'] : 'border-slate-200' }} overflow-hidden shadow-sm hover:shadow-md transition-all">
                        <div class="p-6">
                            <div class="flex items-start gap-6">
                                {{-- Level Icon --}}
                                <div class="flex-shrink-0">
                                    <div class="w-20 h-20 rounded-xl {{ $isUnlocked ? 'bg-gradient-to-br ' . $color['gradient'] : 'bg-slate-200' }} flex items-center justify-center">
                                        @if($isUnlocked)
                                            <span class="text-3xl font-bold text-white">{{ $level }}</span>
                                        @else
                                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                            </svg>
                                        @endif
                                    </div>
                                </div>

                                {{-- Level Info --}}
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="text-2xl font-bold text-slate-900">Level {{ $level }}</h3>
                                        @if(!$isUnlocked)
                                            <span class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded-full">
                                                🔒 Locked
                                            </span>
                                        @elseif($bestScore)
                                            <span class="px-3 py-1 {{ $bestScore >= 80 ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }} text-xs font-bold rounded-full">
                                                Best: {{ number_format($bestScore, 1) }}%
                                            </span>
                                        @endif
                                    </div>

                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                        <div class="flex items-center gap-2 text-sm text-slate-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>8 Soal</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-sm text-slate-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <span>{{ $level }} poin/soal</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-sm text-slate-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                            </svg>
                                            <span>Max {{ $maxPoints }} poin</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-sm text-slate-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>~10 menit</span>
                                        </div>
                                    </div>

                                    @if(!$isUnlocked)
                                        <div class="p-3 bg-amber-50 border border-amber-200 rounded-lg mb-4">
                                            <p class="text-sm text-amber-800 flex items-center gap-2">
                                                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                                </svg>
                                                <span>
                                                    Selesaikan Level {{ $level - 1 }} dengan score minimal <strong>80%</strong> untuk membuka level ini
                                                    @if($progress->getBestScore($level - 1))
                                                        (Skor terbaikmu: <strong>{{ number_format($progress->getBestScore($level - 1), 1) }}%</strong>)
                                                    @endif
                                                </span>
                                            </p>
                                        </div>
                                    @endif

                                    {{-- Action Button --}}
                                    @if($isUnlocked && $isAvailable)
                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('evaluasi.start-level', ['pillar' => $pillar, 'level' => $level]) }}" class="px-6 py-3 {{ $color['bg'] }} text-white font-bold rounded-xl hover:opacity-90 transition-opacity flex items-center gap-2">
                                                @if($bestScore)
                                                    🔄 Coba Lagi
                                                @else
                                                    ▶️ Mulai Quiz
                                                @endif
                                            </a>

                                            @if($bestScore)
                                                <div class="flex items-center gap-2 text-sm text-slate-600">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <span>Pernah dikerjakan</span>
                                                </div>
                                            @endif
                                        </div>
                                    @elseif(!$isAvailable)
                                        <button disabled class="px-6 py-3 bg-slate-200 text-slate-500 font-bold rounded-xl cursor-not-allowed">
                                            Belum Tersedia
                                        </button>
                                    @else
                                        <button disabled class="px-6 py-3 bg-slate-200 text-slate-500 font-bold rounded-xl cursor-not-allowed flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                            </svg>
                                            Terkunci
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

            {{-- Info Banner --}}
            <div class="mt-8 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl border border-indigo-100 p-6">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900 mb-2">💡 Tips Sukses</h3>
                        <ul class="space-y-1 text-sm text-slate-700">
                            <li class="flex items-center gap-2">
                                <span class="text-indigo-600">▸</span>
                                <span>Soal harus dijawab secara berurutan (sequential)</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-indigo-600">▸</span>
                                <span>Jawaban tidak bisa diubah setelah submit</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-indigo-600">▸</span>
                                <span>Feedback akan ditampilkan setelah semua soal selesai</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-indigo-600">▸</span>
                                <span>Kamu bisa retake berkali-kali, best score yang disimpan</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</x-learning-layout>
