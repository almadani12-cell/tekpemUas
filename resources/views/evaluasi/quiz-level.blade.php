<x-learning-layout>
    @php 
        $title = 'Quiz ' . $pillar->name . ' - Level ' . $level;
        
        $colorClasses = [
            'indigo' => ['gradient' => 'from-indigo-600 to-indigo-800', 'bg' => 'bg-indigo-600', 'text' => 'text-indigo-600'],
            'teal' => ['gradient' => 'from-teal-600 to-teal-800', 'bg' => 'bg-teal-600', 'text' => 'text-teal-600'],
            'amber' => ['gradient' => 'from-amber-600 to-amber-800', 'bg' => 'bg-amber-600', 'text' => 'text-amber-600'],
            'rose' => ['gradient' => 'from-rose-600 to-rose-800', 'bg' => 'bg-rose-600', 'text' => 'text-rose-600'],
        ];
        $color = $colorClasses[$pillar->color] ?? $colorClasses['indigo'];
    @endphp

    {{-- Progress Bar --}}
    <div class="sticky top-0 bg-white border-b border-slate-200 z-40">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-slate-700">Progres: {{ $progress }}/{{ $totalQuestions }}</span>
                <div class="flex-1 h-2 bg-slate-200 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r {{ $color['gradient'] }} rounded-full transition-all duration-300" style="width: {{ ($progress / $totalQuestions) * 100 }}%"></div>
                </div>
                <span class="text-sm font-semibold {{ $color['text'] }}">{{ round(($progress / $totalQuestions) * 100) }}%</span>
            </div>
        </div>
    </div>

    {{-- Quiz Content with Alpine.js scope --}}
    <section class="py-8 bg-slate-50 min-h-screen" x-data="{ showModal: false }">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Level Badge --}}
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">{{ $pillar->name }} - Level {{ $level }}</h2>
                    <p class="text-slate-600">{{ $quizData['instructions'] ?? 'Jawab setiap soal dengan teliti.' }}</p>
                </div>
                <div class="px-4 py-2 bg-gradient-to-r {{ $color['gradient'] }} text-white rounded-xl font-bold">
                    Level {{ $level }}
                </div>
            </div>

            <form action="{{ route('evaluasi.submit-answer', ['pillar' => $pillar, 'level' => $level, 'attempt' => $attempt]) }}" method="POST" id="quiz-form">
                @csrf
                <input type="hidden" name="question_id" value="{{ $currentQuestion['id'] }}">
                
                {{-- Render Question Based on Type --}}
                @if($currentQuestion['type'] === 'one_choice')
                    <x-quiz-one-choice 
                        :question="$currentQuestion" 
                        :questionNumber="$currentIndex + 1" 
                        :totalQuestions="$totalQuestions" 
                    />
                @elseif($currentQuestion['type'] === 'multiple_choices')
                    <x-quiz-multiple-choices 
                        :question="$currentQuestion" 
                        :questionNumber="$currentIndex + 1" 
                        :totalQuestions="$totalQuestions" 
                    />
                @elseif($currentQuestion['type'] === 'drag_drop')
                    <x-quiz-drag-drop-level 
                        :question="$currentQuestion" 
                        :questionNumber="$currentIndex + 1" 
                        :totalQuestions="$totalQuestions" 
                    />
                @endif

                {{-- Submit Button --}}
                <div class="mt-6 flex justify-between items-center">
                    <div class="text-sm text-slate-600">
                        ⚠️ Jawaban tidak dapat diubah setelah submit
                    </div>
                    <button type="button" @click="showModal = true" class="px-8 py-3 {{ $color['bg'] }} text-white font-bold rounded-xl hover:opacity-90 transition-opacity flex items-center gap-2">
                        @if($currentIndex + 1 >= $totalQuestions)
                            Jawab & Lihat Hasil
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
                            $qId = $quizData['questions'][$i]['id'] ?? null;
                            $isAnswered = $qId && in_array($qId, $answeredQuestions);
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

        {{-- Custom Confirmation Modal --}}
        <div x-cloak>
            {{-- Modal Backdrop --}}
            <div x-show="showModal" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
                 @click.self="showModal = false"
                 @keydown.escape.window="showModal = false">
                
                {{-- Modal Content --}}
                <div x-show="showModal"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="bg-white rounded-2xl shadow-2xl max-w-md w-full overflow-hidden">
                    
                    {{-- Modal Header --}}
                    <div class="bg-gradient-to-r {{ $color['gradient'] }} p-6 text-white">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold">Konfirmasi Jawaban</h3>
                                <p class="text-sm text-white/80">Pastikan jawaban Anda sudah benar</p>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Body --}}
                    <div class="p-6">
                        <div class="mb-6">
                            <p class="text-slate-700 text-lg mb-3">
                                Apakah Anda yakin dengan jawaban ini?
                            </p>
                            <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 flex items-start gap-3">
                                <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <div class="text-sm text-amber-800">
                                    <strong>Perhatian:</strong> Jawaban tidak dapat diubah setelah Anda submit!
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex gap-3">
                            <button type="button" 
                                    @click="showModal = false"
                                    class="flex-1 px-4 py-3 bg-slate-100 text-slate-700 font-semibold rounded-xl hover:bg-slate-200 transition-colors">
                                Batal
                            </button>
                            <button type="button"
                                    @click="document.getElementById('quiz-form').submit()"
                                    class="flex-1 px-4 py-3 {{ $color['bg'] }} text-white font-semibold rounded-xl hover:opacity-90 transition-opacity flex items-center justify-center gap-2">
                                Ya, Submit
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-learning-layout>
