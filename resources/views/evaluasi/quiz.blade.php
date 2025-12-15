<x-learning-layout>
    @php 
        $title = 'Quiz ' . $pillar->name;

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
        titleHighlight="Pengujian"
        badge="✅ PENGUJIAN PENGETAHUAN"
        :description="$quiz->title"
        :breadcrumb="[
            ['name' => 'Dashboard', 'url' => route('dashboard')],
            ['name' => 'Evaluasi', 'url' => route('evaluasi.index')],
            ['name' => 'Quiz ' . $pillar->name]
        ]"
    />

    {{-- Progress Bar --}}
    <div class="sticky top-20 bg-white border-b border-slate-200 z-40">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-slate-700">Progres: {{ $progress }}/{{ $totalQuestions }}</span>
                <div class="flex-1 h-2 bg-slate-200 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full transition-all duration-300" style="width: {{ ($progress / $totalQuestions) * 100 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Feedback Modal --}}
    @if(session('feedback'))
        @php $feedback = session('feedback'); @endphp
        <div x-data="{ show: true }" x-show="show" x-cloak class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full overflow-hidden" x-show="show" x-transition>
                {{-- Feedback Header --}}
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
                </div>
                
                {{-- Feedback Body --}}
                <div class="p-6">
                    @if(!$feedback['is_correct'])
                        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-xl">
                            <h4 class="font-semibold text-green-800 mb-1">Jawaban yang benar:</h4>
                            @if(isset($feedback['correct_answer']))
                                <p class="text-green-700">{{ $feedback['correct_answer'] }}</p>
                            @elseif(isset($feedback['correct_order']))
                                <ol class="list-decimal list-inside text-green-700">
                                    @foreach($feedback['correct_order'] as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ol>
                            @endif
                        </div>
                    @endif
                    
                    @if($feedback['explanation'])
                        <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl">
                            <h4 class="font-semibold text-slate-800 mb-1">Penjelasan:</h4>
                            <p class="text-slate-600 text-sm">{{ $feedback['explanation'] }}</p>
                        </div>
                    @endif
                </div>
                
                {{-- Feedback Footer --}}
                <div class="p-6 bg-white border-t border-slate-100">
                    <button @click="show = false" class="w-full py-3 {{ $color['bg'] }} text-white font-bold rounded-xl hover:opacity-90 transition-opacity">
                        Lanjut ke Soal Berikutnya
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Quiz Content --}}
    <section class="py-8 bg-slate-50 min-h-[60vh]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('evaluasi.answer', ['pillar' => $pillar, 'attempt' => $attempt]) }}" method="POST" id="quiz-form">
                @csrf
                <input type="hidden" name="question_id" value="{{ $currentQuestion->id }}">
                
                @if($currentQuestion->isMultipleChoice())
                    <x-quiz-multiple-choice 
                        :question="$currentQuestion" 
                        :questionNumber="$currentIndex + 1" 
                        :totalQuestions="$totalQuestions" 
                    />
                @else
                    <x-quiz-drag-drop 
                        :question="$currentQuestion" 
                        :questionNumber="$currentIndex + 1" 
                        :totalQuestions="$totalQuestions" 
                    />
                @endif

                {{-- Submit Button --}}
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="px-8 py-3 {{ $color['bg'] }} text-white font-bold rounded-xl hover:opacity-90 transition-opacity flex items-center gap-2">
                        @if($currentIndex + 1 >= $totalQuestions)
                            Selesai & Lihat Hasil
                        @else
                            Jawab & Lanjut
                        @endif
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </form>

            {{-- Question Navigator --}}
            <div class="mt-8 bg-white rounded-2xl border border-slate-200 p-6">
                <h3 class="font-semibold text-slate-900 mb-4">Navigasi Soal</h3>
                <div class="flex flex-wrap gap-2">
                    @for($i = 0; $i < $totalQuestions; $i++)
                        @php
                            $qId = $quiz->questions[$i]->id ?? null;
                            $isAnswered = $qId && in_array($qId, $answeredQuestionIds);
                            $isCurrent = $i === $currentIndex;
                        @endphp
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center text-sm font-bold
                            {{ $isAnswered ? 'bg-green-500 text-white' : ($isCurrent ? $color['bg'] . ' text-white' : 'bg-slate-100 text-slate-600') }}">
                            {{ $i + 1 }}
                        </div>
                    @endfor
                </div>
                <div class="flex items-center gap-4 mt-4 text-xs text-slate-500">
                    <span class="flex items-center gap-1">
                        <span class="w-3 h-3 bg-green-500 rounded"></span> Sudah Dijawab
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="w-3 h-3 {{ $color['bg'] }} rounded"></span> Saat Ini
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="w-3 h-3 bg-slate-100 rounded border border-slate-200"></span> Belum Dijawab
                    </span>
                </div>
            </div>
        </div>
    </section>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</x-learning-layout>
