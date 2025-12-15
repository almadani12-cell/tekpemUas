<div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-500">DRAG & DROP - URUTKAN</span>
            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">
                Soal {{ $questionNumber }}/{{ $totalQuestions }}
            </span>
        </div>
        
        <h3 class="text-xl font-bold text-slate-900 leading-relaxed mb-2">
            {{ $question['content'] }}
        </h3>
        
        @if(isset($question['instruction']))
            <p class="text-sm text-slate-600">
                {{ $question['instruction'] }}
            </p>
        @endif
    </div>

    @if($question['drag_drop_type'] === 'sequence')
        {{-- Sequence Type: Drag to reorder --}}
        <div 
            x-data="sortableList({{ json_encode($question['items']) }})"
            x-init="initSortable()"
            class="space-y-3"
        >
            <div id="sortable-container" class="space-y-3">
                <template x-for="(item, index) in items" :key="item.id">
                    <div 
                        :data-id="item.id"
                        class="flex items-center gap-4 p-4 bg-slate-50 border-2 border-slate-200 rounded-xl cursor-move hover:border-green-400 hover:bg-green-50 transition-all"
                    >
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-green-100 text-green-700 font-bold text-sm mr-3" x-text="index + 1"></span>
                            <span class="font-medium text-slate-800" x-text="item.text"></span>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Hidden input for form submission --}}
            <template x-for="(item, index) in items" :key="'input-' + item.id">
                <input type="hidden" name="sequence[]" :value="item.id">
            </template>

            <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-sm text-blue-800">
                        <strong>Petunjuk:</strong> Klik dan drag item untuk mengurutkan. Urutan nomor akan berubah otomatis.
                    </p>
                </div>
            </div>
        </div>

    @elseif($question['drag_drop_type'] === 'matching')
        {{-- Matching Type: Connect pairs --}}
        <div x-data="matchingPairs()">
            <div class="space-y-4">
                @foreach($question['pairs'] as $index => $pair)
                    <div class="grid md:grid-cols-2 gap-4 items-center">
                        {{-- Left side (fixed) --}}
                        <div class="p-4 bg-slate-100 border-2 border-slate-300 rounded-xl">
                            <span class="font-bold text-slate-700">{{ $pair['left_id'] }}.</span>
                            <span class="ml-2 text-slate-900">{{ $pair['left'] }}</span>
                        </div>

                        {{-- Right side (dropdown to select) --}}
                        <div>
                            <select 
                                name="matches[{{ $pair['left_id'] }}]" 
                                class="w-full p-4 border-2 border-slate-200 rounded-xl font-medium text-slate-700 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all"
                                required
                            >
                                <option value="">-- Pilih Pasangan --</option>
                                @foreach($question['right_items'] as $rightItem)
                                    <option value="{{ $rightItem['id'] }}">
                                        {{ $rightItem['id'] }}. {{ $rightItem['text'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-sm text-blue-800">
                        <strong>Petunjuk:</strong> Pilih pasangan yang tepat untuk setiap item di sebelah kiri.
                    </p>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
function sortableList(initialItems) {
    return {
        items: initialItems,
        sortable: null,
        
        initSortable() {
            const container = document.getElementById('sortable-container');
            this.sortable = Sortable.create(container, {
                animation: 150,
                ghostClass: 'opacity-50',
                onEnd: (evt) => {
                    // Update items array based on new order
                    const newItems = [];
                    const children = container.children;
                    for (let i = 0; i < children.length; i++) {
                        const id = children[i].getAttribute('data-id');
                        const item = this.items.find(item => item.id === id);
                        if (item) newItems.push(item);
                    }
                    this.items = newItems;
                }
            });
        }
    }
}

function matchingPairs() {
    return {
        selections: {}
    }
}
</script>
@endpush
