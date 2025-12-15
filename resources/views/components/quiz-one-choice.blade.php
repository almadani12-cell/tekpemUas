<div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-500">PILIHAN GANDA</span>
            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">
                Soal {{ $questionNumber }}/{{ $totalQuestions }}
            </span>
        </div>
        
        <h3 class="text-xl font-bold text-slate-900 leading-relaxed">
            {{ $question['content'] }}
        </h3>
    </div>

    <div class="space-y-3">
        @foreach($question['options'] as $option)
            <label class="block">
                <input 
                    type="radio" 
                    name="selected_option" 
                    value="{{ $option['id'] }}" 
                    class="peer sr-only" 
                    required
                >
                <div class="flex items-center gap-4 p-4 border-2 border-slate-200 rounded-xl cursor-pointer transition-all hover:border-indigo-300 hover:bg-indigo-50 peer-checked:border-indigo-600 peer-checked:bg-indigo-50">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full border-2 border-slate-300 flex items-center justify-center peer-checked:border-indigo-600 peer-checked:bg-indigo-600">
                        <svg class="w-5 h-5 text-white hidden peer-checked:block" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="flex-1 font-semibold text-slate-700 peer-checked:text-indigo-900">
                        {{ $option['id'] }}. {{ $option['text'] }}
                    </span>
                </div>
            </label>
        @endforeach
    </div>
</div>
