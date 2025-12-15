<x-learning-layout>
    @php $title = 'Materi'; @endphp

    {{-- Hero Section --}}
    <x-page-hero 
        :title="'' . ''" 
        titleHighlight="Pilih Jenis Materi"
        description="Pilih format materi yang ingin kamu pelajari - Teks, Video, atau CP & TP"
        :breadcrumb="[
            ['name' => 'Dashboard', 'url' => route('dashboard')],
            ['name' => 'Materi']
        ]"
    />

    {{-- Content --}}
    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Materi Teks --}}
                <a href="{{ route('materi.show', ['pillar' => 'dekomposisi', 'type' => 'text']) }}" class="group bg-white rounded-2xl border border-slate-200 overflow-hidden card-hover fade-in-up">
                    <div class="h-48 bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center relative">
                        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
                        <svg class="w-20 h-20 text-white relative z-10 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-indigo-600 transition-colors">Materi Teks</h3>
                        <p class="text-slate-600 text-sm mb-4">Baca dan pahami konsep berpikir komputasional melalui materi teks yang terstruktur.</p>
                        <div class="flex items-center text-indigo-600 font-semibold text-sm">
                            Mulai Belajar
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>

                {{-- Materi Video --}}
                <a href="{{ route('materi.show', ['pillar' => 'dekomposisi', 'type' => 'video']) }}" class="group bg-white rounded-2xl border border-slate-200 overflow-hidden card-hover fade-in-up delay-100">
                    <div class="h-48 bg-gradient-to-br from-teal-500 to-teal-600 flex items-center justify-center relative">
                        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
                        <svg class="w-20 h-20 text-white relative z-10 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-teal-600 transition-colors">Materi Video</h3>
                        <p class="text-slate-600 text-sm mb-4">Tonton video pembelajaran untuk memahami konsep dengan visualisasi yang menarik.</p>
                        <div class="flex items-center text-teal-600 font-semibold text-sm">
                            Mulai Belajar
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>

                {{-- CP & TP --}}
                <a href="{{ route('materi.cptp') }}" class="group bg-white rounded-2xl border border-slate-200 overflow-hidden card-hover fade-in-up delay-200">
                    <div class="h-48 bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center relative">
                        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
                        <svg class="w-20 h-20 text-white relative z-10 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-amber-600 transition-colors">CP & TP</h3>
                        <p class="text-slate-600 text-sm mb-4">Capaian Pembelajaran dan Tujuan Pembelajaran yang harus dikuasai.</p>
                        <div class="flex items-center text-amber-600 font-semibold text-sm">
                            Lihat Detail
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Quick Access to Pillars --}}
            <div class="mt-16">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Akses Cepat ke Pilar</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($pillars as $pillar)
                        @php
                            $colorClasses = [
                                'indigo' => 'border-indigo-200 hover:border-indigo-400 hover:bg-indigo-50',
                                'teal' => 'border-teal-200 hover:border-teal-400 hover:bg-teal-50',
                                'amber' => 'border-amber-200 hover:border-amber-400 hover:bg-amber-50',
                                'rose' => 'border-rose-200 hover:border-rose-400 hover:bg-rose-50',
                            ];
                            $iconColors = [
                                'indigo' => 'bg-indigo-100 text-indigo-600',
                                'teal' => 'bg-teal-100 text-teal-600',
                                'amber' => 'bg-amber-100 text-amber-600',
                                'rose' => 'bg-rose-100 text-rose-600',
                            ];
                        @endphp
                        <div class="bg-white rounded-xl border-2 {{ $colorClasses[$pillar->color] ?? 'border-slate-200' }} p-4 transition-all">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 rounded-lg {{ $iconColors[$pillar->color] ?? 'bg-slate-100 text-slate-600' }} flex items-center justify-center">
                                    @switch($pillar->slug)
                                        @case('dekomposisi')
                                            🧩
                                            @break
                                        @case('pengenalan-pola')
                                            🔍
                                            @break
                                        @case('abstraksi')
                                            💡
                                            @break
                                        @case('algoritma')
                                            📝
                                            @break
                                    @endswitch
                                </div>
                                <h4 class="font-bold text-slate-900">{{ $pillar->name }}</h4>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('materi.show', ['pillar' => $pillar->slug, 'type' => 'text']) }}" class="flex-1 text-center py-2 text-xs font-medium bg-slate-100 text-slate-600 rounded-lg hover:bg-slate-200 transition-colors">
                                    Teks
                                </a>
                                <a href="{{ route('materi.show', ['pillar' => $pillar->slug, 'type' => 'video']) }}" class="flex-1 text-center py-2 text-xs font-medium bg-slate-100 text-slate-600 rounded-lg hover:bg-slate-200 transition-colors">
                                    Video
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-learning-layout>
