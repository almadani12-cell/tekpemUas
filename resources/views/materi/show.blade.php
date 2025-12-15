<x-learning-layout>
    @php 
        $title = $pillar->name . ' - ' . ($type === 'text' ? 'Materi Teks' : 'Materi Video');
        $typeLabel = $type === 'text' ? 'Materi Teks' : 'Materi Video';

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
        :title="$pillar->name"
        description="{{ $typeLabel }} - Pelajari materi {{ $pillar->name }} secara mendalam"
        :breadcrumb="[
            ['name' => 'Dashboard', 'url' => route('dashboard')],
            ['name' => 'Materi', 'url' => route('materi.index')],
            ['name' => $pillar->name]
        ]"
    />

    {{-- Page Content --}}
    <section class="py-12 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                {{-- Main Content --}}
                <div class="lg:w-2/3">
                    @if(isset($hasContent) && $hasContent)
                        {{-- Include content from blade file --}}
                        <div class="space-y-6 fade-in-up">
                            @include($contentPath)
                        </div>
                    @else
                        {{-- Empty state when content file doesn't exist --}}
                        <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center">
                            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Materi</h3>
                            <p class="text-slate-500">Materi {{ $type === 'text' ? 'teks' : 'video' }} untuk pilar ini belum tersedia.</p>
                            <p class="text-xs text-slate-400 mt-2">File: {{ $pillar->slug }}.blade.php</p>
                        </div>
                    @endif

                    {{-- Navigation Buttons --}}
                    <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-between">
                        <a href="{{ route('materi.index') }}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-slate-200 text-slate-600 font-bold rounded-xl hover:border-slate-300 hover:bg-white transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Kembali
                        </a>
                        <a href="{{ route('evaluasi.start', $pillar) }}" class="inline-flex items-center justify-center px-6 py-3 {{ $color['bg'] }} text-white font-bold rounded-xl hover:opacity-90 transition-opacity">
                            Kerjakan Quiz {{ $pillar->name }}
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="lg:w-1/3">
                    <div class="sticky top-24 space-y-6">
                        {{-- Pillar Navigation --}}
                        <div class="bg-white rounded-2xl border border-slate-200 p-6">
                            <h3 class="font-bold text-slate-900 mb-4">Pilar Lainnya</h3>
                            <div class="space-y-2">
                                @foreach($allPillars as $p)
                                    @php
                                        $isActive = $p->id === $pillar->id;
                                        $pColors = [
                                            'indigo' => 'hover:bg-indigo-50 hover:border-indigo-200',
                                            'teal' => 'hover:bg-teal-50 hover:border-teal-200',
                                            'amber' => 'hover:bg-amber-50 hover:border-amber-200',
                                            'rose' => 'hover:bg-rose-50 hover:border-rose-200',
                                        ];
                                    @endphp
                                    <a 
                                        href="{{ route('materi.show', ['pillar' => $p->slug, 'type' => $type]) }}"
                                        class="flex items-center gap-3 p-3 rounded-xl border {{ $isActive ? $color['border'] . ' bg-slate-50' : 'border-transparent ' . ($pColors[$p->color] ?? '') }} transition-colors"
                                    >
                                        <span class="text-xl">
                                            @switch($p->slug)
                                                @case('dekomposisi') 🧩 @break
                                                @case('pengenalan-pola') 🔍 @break
                                                @case('abstraksi') 💡 @break
                                                @case('algoritma') 📝 @break
                                            @endswitch
                                        </span>
                                        <span class="font-medium {{ $isActive ? 'text-slate-900' : 'text-slate-600' }}">{{ $p->name }}</span>
                                        @if($isActive)
                                            <svg class="w-4 h-4 ml-auto {{ $color['text'] }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        {{-- Type Switch --}}
                        <div class="bg-white rounded-2xl border border-slate-200 p-6">
                            <h3 class="font-bold text-slate-900 mb-4">Ganti Format</h3>
                            <div class="flex gap-2">
                                <a 
                                    href="{{ route('materi.show', ['pillar' => $pillar->slug, 'type' => 'text']) }}"
                                    class="flex-1 py-3 px-4 rounded-xl text-center font-medium transition-colors {{ $type === 'text' ? $color['bg'] . ' text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                                >
                                    📖 Teks
                                </a>
                                <a 
                                    href="{{ route('materi.show', ['pillar' => $pillar->slug, 'type' => 'video']) }}"
                                    class="flex-1 py-3 px-4 rounded-xl text-center font-medium transition-colors {{ $type === 'video' ? $color['bg'] . ' text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                                >
                                    🎬 Video
                                </a>
                            </div>
                        </div>

                        {{-- Quick Actions --}}
                        <div class="bg-gradient-to-br {{ $color['gradient'] }} rounded-2xl p-6 text-white">
                            <h3 class="font-bold mb-2">Sudah Paham?</h3>
                            <p class="text-sm text-white/80 mb-4">Uji pemahamanmu dengan mengerjakan quiz untuk pilar ini.</p>
                            <a href="{{ route('evaluasi.start', $pillar) }}" class="block w-full py-3 bg-white text-slate-900 rounded-xl text-center font-bold hover:bg-slate-100 transition-colors">
                                Mulai Quiz
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-learning-layout>
