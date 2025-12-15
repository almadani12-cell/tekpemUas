<div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-500">PILIHAN GANDA - PILIH LEBIH DARI SATU</span>
            <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs font-bold rounded-full">
                Soal {{ $questionNumber }}/{{ $totalQuestions }}
            </span>
        </div>
        
        <h3 class="text-xl font-bold text-slate-900 leading-relaxed mb-2">
            {{ $question['content'] }}
        </h3>
        
        @if(isset($question['hint']))
            <p class="text-sm text-amber-600 font-medium flex items-center gap-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                {{ $question['hint'] }}
            </p>
        @endif
    </div>

    <div class="space-y-3" x-data="{ selected: [] }">
        @foreach($question['options'] as $option)
            <label class="block">
                <input 
                    type="checkbox" 
                    name="selected_options[]" 
                    value="{{ $option['id'] }}" 
                    class="peer sr-only"
                    x-model="selected"
                >
                <div class="flex items-center gap-4 p-4 border-2 border-slate-200 rounded-xl cursor-pointer transition-all hover:border-purple-300 hover:bg-purple-50 peer-checked:border-purple-600 peer-checked:bg-purple-50">
                    <div class="flex-shrink-0 w-8 h-8 rounded-lg border-2 border-slate-300 flex items-center justify-center peer-checked:border-purple-600 peer-checked:bg-purple-600">
                        <svg class="w-5 h-5 text-white hidden peer-checked:block" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="flex-1 font-semibold text-slate-700 peer-checked:text-purple-900">
                        {{ $option['id'] }}. {{ $option['text'] }}
                    </span>
                </div>
            </label>
        @endforeach

        <div class="mt-4 p-3 bg-slate-50 rounded-lg text-sm text-slate-600" x-show="selected.length > 0">
            <span class="font-semibold" x-text="selected.length"></span> jawaban terpilih
        </div>
    </div>
</div>
