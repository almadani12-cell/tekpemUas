@props([
    'question',
    'questionNumber' => 1,
    'totalQuestions' => 1,
])

@php
    // Shuffle options for display
    $shuffledOptions = $question->options->shuffle();
@endphp

<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
    {{-- Question Header --}}
    <div class="bg-gradient-to-r from-amber-500 to-orange-600 px-6 py-4">
        <div class="flex items-center justify-between text-white">
            <span class="text-sm font-medium opacity-90">Soal {{ $questionNumber }} dari {{ $totalQuestions }}</span>
            <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-medium">Urutkan (Drag & Drop)</span>
        </div>
    </div>
    
    {{-- Question Content --}}
    <div class="p-6">
        <p class="text-lg text-slate-800 font-medium mb-4 leading-relaxed">
            {{ $question->content }}
        </p>
        
        <p class="text-sm text-slate-500 mb-4 flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Seret dan urutkan item di bawah ini sesuai urutan yang benar (dari atas ke bawah)
        </p>
        
        {{-- Sortable Items --}}
        <div id="sortable-{{ $question->id }}" class="space-y-2">
            @foreach($shuffledOptions as $index => $option)
                <div class="drag-item flex items-center p-4 rounded-xl border-2 border-slate-200 bg-white cursor-grab active:cursor-grabbing hover:border-amber-300 hover:bg-amber-50 transition-all" data-id="{{ $option->id }}">
                    <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center mr-4">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                        </svg>
                    </div>
                    <span class="text-slate-700 flex-1">{{ $option->content }}</span>
                    <div class="drag-number w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-600">
                        {{ $index + 1 }}
                    </div>
                </div>
            @endforeach
        </div>
        
        {{-- Hidden input for order --}}
        <input type="hidden" name="drag_drop_order" id="drag-drop-order-{{ $question->id }}" value="">
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sortableEl = document.getElementById('sortable-{{ $question->id }}');
        const orderInput = document.getElementById('drag-drop-order-{{ $question->id }}');
        
        if (sortableEl && typeof Sortable !== 'undefined') {
            const sortable = Sortable.create(sortableEl, {
                animation: 150,
                ghostClass: 'sortable-ghost',
                chosenClass: 'sortable-chosen',
                dragClass: 'sortable-drag',
                onEnd: function() {
                    updateOrder();
                    updateNumbers();
                }
            });
            
            function updateOrder() {
                const items = sortableEl.querySelectorAll('.drag-item');
                const order = Array.from(items).map(item => parseInt(item.dataset.id));
                orderInput.value = JSON.stringify(order);
            }
            
            function updateNumbers() {
                const items = sortableEl.querySelectorAll('.drag-item');
                items.forEach((item, index) => {
                    const numberEl = item.querySelector('.drag-number');
                    if (numberEl) {
                        numberEl.textContent = index + 1;
                    }
                });
            }
            
            // Initialize order
            updateOrder();
        }
    });
</script>
