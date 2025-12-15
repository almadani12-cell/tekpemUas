@props([
    'value' => 0,
    'label' => '',
    'icon' => null,
    'color' => 'indigo',
    'suffix' => '',
])

@php
    $colorClasses = [
        'indigo' => 'text-indigo-600 bg-indigo-50',
        'teal' => 'text-teal-600 bg-teal-50',
        'amber' => 'text-amber-600 bg-amber-50',
        'rose' => 'text-rose-600 bg-rose-50',
        'green' => 'text-green-600 bg-green-50',
        'blue' => 'text-blue-600 bg-blue-50',
    ];
    $colorClass = $colorClasses[$color] ?? $colorClasses['indigo'];
@endphp

<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl border border-slate-200 p-6 card-hover']) }}>
    <div class="flex items-start justify-between">
        <div>
            <p class="text-3xl font-extrabold text-slate-900">
                {{ $value }}{{ $suffix }}
            </p>
            <p class="text-sm font-medium text-slate-500 mt-1">{{ $label }}</p>
        </div>
        @if($icon)
            <div class="w-12 h-12 rounded-xl {{ $colorClass }} flex items-center justify-center">
                {!! $icon !!}
            </div>
        @endif
    </div>
    {{ $slot }}
</div>
