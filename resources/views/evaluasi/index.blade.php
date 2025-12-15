<x-learning-layout>
    @php $title = 'Evaluasi'; @endphp

    {{-- Hero Section --}}
    <x-page-hero 
        :title="' ' . ''"
        titleHighlight="Evaluasi Quiz"
        description="Pilih pilar dan uji pemahamanmu dengan quiz interaktif yang dirancang khusus"
        :breadcrumb="[
            ['name' => 'Dashboard', 'url' => route('dashboard')],
            ['name' => 'Evaluasi']
        ]"
    />

    {{-- Content --}}
    <section class="py-12 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-6">Pilih Pilar Quiz</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($pillars as $index => $pillar)
                    @php
                        $colorClasses = [
                            'indigo' => ['gradient' => 'from-indigo-500 to-indigo-600', 'bg' => 'bg-indigo-500', 'hover' => 'hover:border-indigo-300'],
                            'teal' => ['gradient' => 'from-teal-500 to-teal-600', 'bg' => 'bg-teal-500', 'hover' => 'hover:border-teal-300'],
                            'amber' => ['gradient' => 'from-amber-500 to-amber-600', 'bg' => 'bg-amber-500', 'hover' => 'hover:border-amber-300'],
                            'rose' => ['gradient' => 'from-rose-500 to-rose-600', 'bg' => 'bg-rose-500', 'hover' => 'hover:border-rose-300'],
                        ];
                        $color = $colorClasses[$pillar->color] ?? $colorClasses['indigo'];
                        $bestScore = $bestScores[$pillar->id] ?? null;
                    @endphp
                    
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden card-hover {{ $color['hover'] }} fade-in-up delay-{{ ($index + 1) * 100 }}">
                        {{-- Card Header --}}
                        <div class="h-32 bg-gradient-to-br {{ $color['gradient'] }} flex items-center justify-center relative">
                            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
                            <span class="text-5xl relative z-10">
                                @switch($pillar->slug)
                                    @case('dekomposisi') 🧩 @break
                                    @case('pengenalan-pola') 🔍 @break
                                    @case('abstraksi') 💡 @break
                                    @case('algoritma') 📝 @break
                                @endswitch
                            </span>
                        </div>
                        
                        {{-- Card Body --}}
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $pillar->name }}</h3>
                            <p class="text-slate-600 text-sm mb-4 line-clamp-2">{{ $pillar->description }}</p>
                            
                            <div class="flex items-center justify-between text-sm text-slate-500 mb-4">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    24 Soal (8 × 3 Level)
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                    </svg>
                                    3 Level
                                </span>
                            </div>
                            
                            @if($pillar->quiz)
                                <a href="{{ route('evaluasi.levels', $pillar) }}" class="block w-full py-3 {{ $color['bg'] }} text-white text-center font-bold rounded-xl hover:opacity-90 transition-opacity">
                                    @if($bestScore !== null)
                                        Lanjutkan Quiz
                                    @else
                                        Mulai Quiz
                                    @endif
                                </a>
                            @else
                                <button disabled class="block w-full py-3 bg-slate-200 text-slate-500 text-center font-bold rounded-xl cursor-not-allowed">
                                    Belum Tersedia
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Info Banner --}}
            <div class="mt-12 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl border border-indigo-100 p-6 flex flex-col md:flex-row items-center gap-6">
                <div class="w-16 h-16 bg-indigo-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div class="flex-1 text-center md:text-left">
                    <h3 class="text-lg font-bold text-slate-900 mb-1">Lihat Progres Belajarmu</h3>
                    <p class="text-slate-600">Setelah menyelesaikan quiz, kamu bisa melihat grafik performa dan saran materi untuk meningkatkan pemahaman.</p>
                </div>
                <a href="{{ route('performa.index') }}" class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-600 transition-colors flex-shrink-0">
                    Lihat Performa
                </a>
            </div>
        </div>
    </section>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</x-learning-layout>
