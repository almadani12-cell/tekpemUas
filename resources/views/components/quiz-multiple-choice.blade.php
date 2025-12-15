@props([
    'question',
    'questionNumber' => 1,
    'totalQuestions' => 1,
])

<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
    {{-- Question Header --}}
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
        <div class="flex items-center justify-between text-white">
            <span class="text-sm font-medium opacity-90">Soal {{ $questionNumber }} dari {{ $totalQuestions }}</span>
            <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-medium">Pilihan Ganda</span>
        </div>
    </div>
    
    {{-- Question Content --}}
    <div class="p-6">
        <p class="text-lg text-slate-800 font-medium mb-6 leading-relaxed">
            {{ $question->content }}
        </p>
        
        {{-- Options --}}
        <div class="space-y-3">
            @foreach($question->options as $index => $option)
                <label class="quiz-option flex items-center p-4 rounded-xl border-2 border-slate-200 cursor-pointer transition-all">
                    <input 
                        type="radio" 
                        name="selected_option_id" 
                        value="{{ $option->id }}" 
                        class="w-5 h-5 text-indigo-600 border-slate-300 focus:ring-indigo-500 focus:ring-offset-0"
                        required
                    >
                    <span class="ml-4 flex items-center">
                        <span class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-sm font-bold text-slate-600 mr-3">
                            {{ chr(65 + $index) }}
                        </span>
                        <span class="text-slate-700">{{ $option->content }}</span>
                    </span>
                </label>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.quiz-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.quiz-option').forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
        });
    });
</script>
