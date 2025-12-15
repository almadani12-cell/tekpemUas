<x-learning-layout>
    @php 
        $title = 'Review Quiz ' . $pillar->name;
        $isPassed = $attempt->score >= 70;
    @endphp

    {{-- Hero Section with Score --}}
    <x-page-hero 
        :title="'Hasil Quiz ' . $pillar->name"
        titleHighlight="Pengujian"
        badge="📊 HASIL EVALUASI"
        :description="'Skor Anda: ' . number_format($attempt->score, 1) . ' - ' . ($isPassed ? 'Lulus' : 'Belum Lulus')"
        :breadcrumb="[
            ['name' => 'Dashboard', 'url' => route('dashboard')],
            ['name' => 'Evaluasi', 'url' => route('evaluasi.index')],
            ['name' => 'Hasil Quiz ' . $pillar->name]
        ]"
    />

    {{-- Last Feedback Modal --}}
    @if(session('last_feedback'))
        @php $feedback = session('last_feedback'); @endphp
        <div x-data="{ show: true }" x-show="show" x-cloak class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full overflow-hidden" x-show="show" x-transition>
                <div class="p-6 {{ $feedback['is_correct'] ? 'bg-green-500' : 'bg-red-500' }} text-white text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-white/20 rounded-full flex items-center justify-center">
                        @if($feedback['is_correct'])
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        @else
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        @endif
                    </div>
                    <h2 class="text-2xl font-bold">{{ $feedback['is_correct'] ? 'Benar! 🎉' : 'Kurang Tepat 😔' }}</h2>
                    <p class="text-white/80 mt-2">Soal terakhir</p>
                </div>
                <div class="p-6 bg-slate-50 border-t border-slate-100">
                    <button @click="show = false" class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:opacity-90 transition-opacity">
                        Lihat Hasil Quiz
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Result Content --}}
    <section class="py-12 bg-gradient-to-b from-slate-50 to-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Score Summary Card --}}
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8 mb-8 fade-in-up text-center">
            <div class="mb-6">
                <div class="w-32 h-32 mx-auto rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center border-4 {{ $isPassed ? 'border-green-400' : 'border-red-400' }}">
                    <div class="text-center">
                        <span class="text-4xl font-extrabold text-white">{{ $attempt->score }}</span>
                        <span class="text-white/80 text-lg">%</span>
                    </div>
                </div>
            </div>
            
            <h1 class="text-3xl font-extrabold text-white mb-2">
                @if($isPassed)
                    Selamat! Kamu Lulus! 🎉
                @else
                    Tetap Semangat! 💪
                @endif
            </h1>
            <p class="text-white/80 text-lg">Quiz {{ $pillar->name }}</p>
            
            {{-- Stats --}}
            <div class="mt-8 grid grid-cols-3 gap-4 max-w-md mx-auto">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                    <p class="text-2xl font-bold text-white">{{ $attempt->correct_answers }}</p>
                    <p class="text-xs text-white/70">Benar</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                    <p class="text-2xl font-bold text-white">{{ $attempt->total_questions - $attempt->correct_answers }}</p>
                    <p class="text-xs text-white/70">Salah</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                    <p class="text-2xl font-bold text-white">{{ $attempt->total_questions }}</p>
                    <p class="text-xs text-white/70">Total Soal</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Review Content --}}
    <section class="py-12 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Action Buttons --}}
            <div class="flex flex-col sm:flex-row gap-4 mb-8">
                <a href="{{ route('evaluasi.start', $pillar) }}" class="flex-1 py-4 {{ $color['bg'] }} text-white text-center font-bold rounded-xl hover:opacity-90 transition-opacity">
                    🔄 Coba Lagi
                </a>
                <a href="{{ route('materi.show', ['pillar' => $pillar->slug, 'type' => 'text']) }}" class="flex-1 py-4 bg-white border-2 border-slate-200 text-slate-700 text-center font-bold rounded-xl hover:border-slate-300 transition-colors">
                    📖 Pelajari Ulang Materi
                </a>
                <a href="{{ route('evaluasi.index') }}" class="flex-1 py-4 bg-white border-2 border-slate-200 text-slate-700 text-center font-bold rounded-xl hover:border-slate-300 transition-colors">
                    📝 Quiz Lain
                </a>
            </div>

            {{-- Rekap Jawaban --}}
            <h2 class="text-2xl font-bold text-slate-900 mb-6">Rekap Jawaban</h2>
            
            <div class="space-y-4">
                @foreach($answers as $index => $answer)
                    @php
                        $question = $answer->question;
                    @endphp
                    <div class="bg-white rounded-2xl border {{ $answer->is_correct ? 'border-green-200' : 'border-red-200' }} overflow-hidden">
                        {{-- Question Header --}}
                        <div class="px-6 py-4 {{ $answer->is_correct ? 'bg-green-50' : 'bg-red-50' }} flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg {{ $answer->is_correct ? 'bg-green-500' : 'bg-red-500' }} text-white flex items-center justify-center">
                                    @if($answer->is_correct)
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    @endif
                                </span>
                                <span class="font-semibold {{ $answer->is_correct ? 'text-green-800' : 'text-red-800' }}">
                                    Soal {{ $index + 1 }}
                                </span>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $question->isMultipleChoice() ? 'bg-indigo-100 text-indigo-600' : 'bg-amber-100 text-amber-700' }}">
                                {{ $question->isMultipleChoice() ? 'Pilihan Ganda' : 'Drag & Drop' }}
                            </span>
                        </div>
                        
                        {{-- Question Content --}}
                        <div class="p-6">
                            <p class="text-slate-800 mb-4">{{ $question->content }}</p>
                            
                            @if($question->isMultipleChoice())
                                {{-- Multiple Choice Review --}}
                                <div class="space-y-2">
                                    @foreach($question->options as $option)
                                        @php
                                            $isSelected = $answer->selected_option_id === $option->id;
                                            $isCorrect = $option->is_correct;
                                        @endphp
                                        <div class="flex items-center p-3 rounded-lg border {{ $isCorrect ? 'border-green-300 bg-green-50' : ($isSelected && !$isCorrect ? 'border-red-300 bg-red-50' : 'border-slate-200') }}">
                                            @if($isSelected)
                                                <span class="w-5 h-5 mr-3 flex-shrink-0">
                                                    @if($isCorrect)
                                                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    @else
                                                        <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    @endif
                                                </span>
                                            @elseif($isCorrect)
                                                <span class="w-5 h-5 mr-3 flex-shrink-0">
                                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </span>
                                            @else
                                                <span class="w-5 h-5 mr-3"></span>
                                            @endif
                                            <span class="{{ $isCorrect ? 'text-green-800' : ($isSelected ? 'text-red-800' : 'text-slate-600') }}">
                                                {{ $option->content }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                {{-- Drag Drop Review --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <h5 class="font-medium text-slate-700 mb-2">Jawabanmu:</h5>
                                        <ol class="list-decimal list-inside space-y-1 text-sm {{ $answer->is_correct ? 'text-green-700' : 'text-red-700' }}">
                                            @if($answer->drag_drop_order)
                                                @foreach($answer->drag_drop_order as $optionId)
                                                    @php $opt = $question->options->find($optionId); @endphp
                                                    <li>{{ $opt ? $opt->content : 'Unknown' }}</li>
                                                @endforeach
                                            @endif
                                        </ol>
                                    </div>
                                    @if(!$answer->is_correct)
                                        <div>
                                            <h5 class="font-medium text-slate-700 mb-2">Urutan yang benar:</h5>
                                            <ol class="list-decimal list-inside space-y-1 text-sm text-green-700">
                                                @foreach($question->options()->orderBy('order')->get() as $opt)
                                                    <li>{{ $opt->content }}</li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    @endif
                                </div>
                            @endif
                            
                            @if($question->explanation)
                                <div class="mt-4 p-4 bg-slate-50 rounded-lg">
                                    <h5 class="font-medium text-slate-700 mb-1">Penjelasan:</h5>
                                    <p class="text-sm text-slate-600">{{ $question->explanation }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Bottom Actions --}}
            <div class="mt-8 text-center">
                <a href="{{ route('performa.index') }}" class="inline-flex items-center px-6 py-3 {{ $color['bg'] }} text-white font-bold rounded-xl hover:opacity-90 transition-opacity">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Lihat Performa Keseluruhan
                </a>
            </div>
        </div>
    </section>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</x-learning-layout>
