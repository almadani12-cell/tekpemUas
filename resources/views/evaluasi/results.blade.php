<x-learning-layout>
    @php 
        $title = 'Hasil Quiz ' . $pillar->name . ' - Level ' . $level;
        
        $colorClasses = [
            'indigo' => ['gradient' => 'from-indigo-600 to-indigo-800', 'bg' => 'bg-indigo-600', 'text' => 'text-indigo-600'],
            'teal' => ['gradient' => 'from-teal-600 to-teal-800', 'bg' => 'bg-teal-600', 'text' => 'text-teal-600'],
            'amber' => ['gradient' => 'from-amber-600 to-amber-800', 'bg' => 'bg-amber-600', 'text' => 'text-amber-600'],
            'rose' => ['gradient' => 'from-rose-600 to-rose-800', 'bg' => 'bg-rose-600', 'text' => 'text-rose-600'],
        ];
        $color = $colorClasses[$pillar->color] ?? $colorClasses['indigo'];
        
        $isPassed = $attempt->percentage >= $quizData['pass_threshold'];
    @endphp

    {{-- Results Header --}}
    <section class="py-12 bg-gradient-to-br {{ $color['gradient'] }} text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-6">
                @if($isPassed)
                    <div class="w-24 h-24 mx-auto mb-4 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h1 class="text-4xl font-bold mb-2">🎉 Selamat!</h1>
                    <p class="text-xl text-white/90">Kamu berhasil menyelesaikan Level {{ $level }}</p>
                @else
                    <div class="w-24 h-24 mx-auto mb-4 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h1 class="text-4xl font-bold mb-2">😔 Belum Berhasil</h1>
                    <p class="text-xl text-white/90">Jangan menyerah! Coba lagi untuk hasil yang lebih baik</p>
                @endif
            </div>

            {{-- Score Cards --}}
            <div class="grid md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                    <div class="text-3xl font-bold mb-1">{{ $attempt->correct_answers }}</div>
                    <div class="text-sm text-white/80">Jawaban Benar</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                    <div class="text-3xl font-bold mb-1">{{ $attempt->points_earned }}</div>
                    <div class="text-sm text-white/80">Total Poin</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                    <div class="text-3xl font-bold mb-1">{{ number_format($attempt->percentage, 1) }}%</div>
                    <div class="text-sm text-white/80">Persentase</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                    <div class="text-3xl font-bold mb-1">
                        @if($isPassed) ✅ @else ❌ @endif
                    </div>
                    <div class="text-sm text-white/80">Status</div>
                </div>
            </div>

            @if($isPassed && $unlocked)
                <div class="bg-green-500/20 backdrop-blur-sm border border-white/30 rounded-xl p-4 mb-6">
                    <p class="font-bold flex items-center justify-center gap-2">
                        🔓 Level {{ $level + 1 }} Terbuka!
                        <span class="text-sm font-normal">Lanjutkan ke level berikutnya</span>
                    </p>
                </div>
            @endif

            @if(!$isPassed)
                <div class="bg-amber-500/20 backdrop-blur-sm border border-white/30 rounded-xl p-4">
                    <p class="text-sm">
                        Kamu perlu <strong>{{ number_format($quizData['pass_threshold'], 0) }}%</strong> untuk membuka level selanjutnya.
                        Kurang <strong>{{ number_format($quizData['pass_threshold'] - $attempt->percentage, 1) }}%</strong> lagi!
                    </p>
                </div>
            @endif
        </div>
    </section>

    {{-- Detailed Review --}}
    <section class="py-12 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-6">📝 Pembahasan Lengkap</h2>

            <div class="space-y-6">
                @foreach($results as $index => $result)
                    @php
                        $question = $result['question'];
                        $answer = $result['answer'];
                        $isCorrect = $answer ? ($answer->is_correct ?? false) : false;
                    @endphp

                    @if(!$answer)
                        {{-- No answer recorded for this question --}}
                        <div class="bg-white rounded-2xl border-2 border-slate-300 overflow-hidden">
                            <div class="p-6 bg-slate-100 border-b border-slate-200">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <span class="px-3 py-1 bg-slate-500 text-white text-xs font-bold rounded-full">
                                                Soal {{ $index + 1 }}
                                            </span>
                                        </div>
                                        <h3 class="text-lg font-bold text-slate-900">{{ $question['content'] }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6">
                                <p class="text-slate-500 italic">Tidak ada jawaban tercatat</p>
                            </div>
                        </div>
                    @else
                    <div class="bg-white rounded-2xl border-2 {{ $isCorrect ? 'border-green-200' : 'border-red-200' }} overflow-hidden">
                        {{-- Question Header --}}
                        <div class="p-6 {{ $isCorrect ? 'bg-green-50' : 'bg-red-50' }} border-b {{ $isCorrect ? 'border-green-200' : 'border-red-200' }}">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <span class="px-3 py-1 {{ $isCorrect ? 'bg-green-500' : 'bg-red-500' }} text-white text-xs font-bold rounded-full">
                                            Soal {{ $index + 1 }}
                                        </span>
                                        <span class="text-xs font-semibold text-slate-500 uppercase">
                                            @if($question['type'] === 'one_choice') Pilihan Ganda
                                            @elseif($question['type'] === 'multiple_choices') Multiple Choices
                                            @elseif($question['type'] === 'drag_drop') Drag & Drop
                                            @endif
                                        </span>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-900">{{ $question['content'] }}</h3>
                                </div>
                                <div class="flex-shrink-0">
                                    @if($isCorrect)
                                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    @else
                                        <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Answer Details --}}
                        <div class="p-6">
                            @if($question['type'] === 'one_choice')
                                <div class="mb-4">
                                    <p class="text-sm font-semibold text-slate-700 mb-2">Jawaban Kamu:</p>
                                    <div class="p-3 bg-slate-50 rounded-lg">
                                        @php
                                            // selected_options is already cast as array in model
                                            $selectedOptions = $answer->selected_options ?? [];
                                            $selectedKey = $selectedOptions[0] ?? null;
                                            $userOption = collect($question['options'])->firstWhere('id', $selectedKey);
                                        @endphp
                                        <span class="font-medium">{{ $userOption['id'] ?? '-' }}. {{ $userOption['text'] ?? 'Tidak ada jawaban' }}</span>
                                    </div>
                                </div>

                                @if(!$isCorrect)
                                    <div class="mb-4">
                                        <p class="text-sm font-semibold text-green-700 mb-2">Jawaban yang Benar:</p>
                                        <div class="p-3 bg-green-50 border border-green-200 rounded-lg">
                                            @php
                                                $correctOption = collect($question['options'])->firstWhere('id', $question['correct_answer']);
                                            @endphp
                                            <span class="font-medium text-green-800">{{ $correctOption['id'] }}. {{ $correctOption['text'] }}</span>
                                        </div>
                                    </div>
                                @endif

                            @elseif($question['type'] === 'multiple_choices')
                                <div class="mb-4">
                                    <p class="text-sm font-semibold text-slate-700 mb-2">Jawaban Kamu:</p>
                                    <div class="p-3 bg-slate-50 rounded-lg">
                                        @php
                                            $selectedOptions = $answer->selected_options ?? [];
                                        @endphp
                                        @if($selectedOptions && count($selectedOptions) > 0)
                                            <ul class="list-disc list-inside space-y-1">
                                                @foreach($selectedOptions as $optId)
                                                    @php
                                                        $opt = collect($question['options'])->firstWhere('id', $optId);
                                                    @endphp
                                                    <li>{{ $opt['id'] ?? '-' }}. {{ $opt['text'] ?? '-' }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-slate-500">Tidak ada jawaban</span>
                                        @endif
                                    </div>
                                </div>

                                @if(!$isCorrect)
                                    <div class="mb-4">
                                        <p class="text-sm font-semibold text-green-700 mb-2">Jawaban yang Benar:</p>
                                        <div class="p-3 bg-green-50 border border-green-200 rounded-lg">
                                            <ul class="list-disc list-inside space-y-1">
                                                @foreach($question['correct_answers'] as $correctId)
                                                    @php
                                                        $opt = collect($question['options'])->firstWhere('id', $correctId);
                                                    @endphp
                                                    <li class="text-green-800">{{ $opt['id'] }}. {{ $opt['text'] }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                            @elseif($question['type'] === 'drag_drop')
                                @if($question['drag_drop_type'] === 'sequence')
                                    <div class="mb-4">
                                        <p class="text-sm font-semibold text-slate-700 mb-2">Urutan Kamu:</p>
                                        <div class="p-3 bg-slate-50 rounded-lg space-y-2">
                                            @php
                                                $dragOrder = $answer->drag_drop_order ?? [];
                                            @endphp
                                            @if($dragOrder)
                                                @foreach($dragOrder as $idx => $itemId)
                                                    @php
                                                        $item = collect($question['items'])->firstWhere('id', $itemId);
                                                    @endphp
                                                    <div class="flex items-center gap-2">
                                                        <span class="font-bold text-slate-500">{{ $idx + 1 }}.</span>
                                                        <span>{{ $item['text'] ?? '-' }}</span>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    @if(!$isCorrect)
                                        <div class="mb-4">
                                            <p class="text-sm font-semibold text-green-700 mb-2">Urutan yang Benar:</p>
                                            <div class="p-3 bg-green-50 border border-green-200 rounded-lg space-y-2">
                                                @foreach($question['correct_order'] as $idx => $itemId)
                                                    @php
                                                        $item = collect($question['items'])->firstWhere('id', $itemId);
                                                    @endphp
                                                    <div class="flex items-center gap-2">
                                                        <span class="font-bold text-green-700">{{ $idx + 1 }}.</span>
                                                        <span class="text-green-800">{{ $item['text'] }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                @elseif($question['drag_drop_type'] === 'matching')
                                    <div class="mb-4">
                                        <p class="text-sm font-semibold text-slate-700 mb-2">Pasangan Kamu:</p>
                                        <div class="space-y-2">
                                            @php
                                                $matchOptions = $answer->selected_options ?? [];
                                            @endphp
                                            @if($matchOptions)
                                                @foreach($matchOptions as $leftId => $rightId)
                                                    @php
                                                        $pair = collect($question['pairs'])->firstWhere('left_id', $leftId);
                                                        $rightItem = collect($question['right_items'])->firstWhere('id', $rightId);
                                                        $isMatch = ($question['correct_matches'][$leftId] ?? null) === $rightId;
                                                    @endphp
                                                    <div class="p-3 {{ $isMatch ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200' }} rounded-lg">
                                                        <span class="font-medium">{{ $pair['left'] ?? '-' }}</span>
                                                        <span class="mx-2">→</span>
                                                        <span class="{{ $isMatch ? 'text-green-700' : 'text-red-700' }}">{{ $rightItem['text'] ?? '-' }}</span>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif

                            {{-- Explanation --}}
                            <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                                <h4 class="font-bold text-blue-900 mb-2 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                    Penjelasan:
                                </h4>
                                <p class="text-sm text-blue-900">{{ $question['explanation'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>

            {{-- Action Buttons --}}
            <div class="mt-8 flex flex-wrap gap-4 justify-center">
                <a href="{{ route('evaluasi.levels', $pillar) }}" class="px-6 py-3 bg-slate-200 text-slate-700 font-bold rounded-xl hover:bg-slate-300 transition-colors">
                    ← Kembali ke Level Selection
                </a>

                @if(!$isPassed || $attempt->percentage < 100)
                    <a href="{{ route('evaluasi.start-level', ['pillar' => $pillar, 'level' => $level]) }}" class="px-6 py-3 {{ $color['bg'] }} text-white font-bold rounded-xl hover:opacity-90 transition-opacity">
                        🔄 Coba Lagi Level {{ $level }}
                    </a>
                @endif

                @if($isPassed && $level < 3 && in_array($level + 1, [1, 2, 3]))
                    <a href="{{ route('evaluasi.start-level', ['pillar' => $pillar, 'level' => $level + 1]) }}" class="px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-bold rounded-xl hover:opacity-90 transition-opacity">
                        ▶️ Lanjut ke Level {{ $level + 1 }}
                    </a>
                @endif
            </div>
        </div>
    </section>
</x-learning-layout>
