@props(['pillar'])

@php
    $colorClasses = [
        'indigo' => [
            'gradient' => 'from-indigo-600 via-indigo-500 to-purple-500',
            'gradient-alt' => 'from-indigo-400 to-purple-400',
            'text' => 'text-indigo-600',
            'hover' => 'hover:shadow-xl hover:shadow-indigo-200',
            'accent' => 'indigo',
        ],
        'teal' => [
            'gradient' => 'from-teal-600 via-teal-500 to-cyan-500',
            'gradient-alt' => 'from-teal-400 to-cyan-400',
            'text' => 'text-teal-600',
            'hover' => 'hover:shadow-xl hover:shadow-teal-200',
            'accent' => 'teal',
        ],
        'amber' => [
            'gradient' => 'from-amber-600 via-amber-500 to-orange-500',
            'gradient-alt' => 'from-amber-400 to-orange-400',
            'text' => 'text-amber-600',
            'hover' => 'hover:shadow-xl hover:shadow-amber-200',
            'accent' => 'amber',
        ],
        'rose' => [
            'gradient' => 'from-rose-600 via-rose-500 to-pink-500',
            'gradient-alt' => 'from-rose-400 to-pink-400',
            'text' => 'text-rose-600',
            'hover' => 'hover:shadow-xl hover:shadow-rose-200',
            'accent' => 'rose',
        ],
    ];
    $color = $colorClasses[$pillar->color] ?? $colorClasses['indigo'];
@endphp

<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl border border-slate-200 overflow-hidden card-hover group transition-all duration-300 ' . $color['hover']]) }}>
    {{-- Icon Header dengan Gradient Modern --}}
    <div class="h-40 bg-gradient-to-br {{ $color['gradient'] }} flex items-center justify-center relative overflow-hidden group-hover:scale-105 transition-transform duration-300">
        {{-- Decorative circles --}}
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
        
        {{-- Icon Emoji --}}
        <div class="relative z-10 text-white text-6xl drop-shadow-lg select-none">
            @switch($pillar->order ?? 0)
                @case(1)
                    🧩
                @break
                @case(2)
                    🔍
                @break
                @case(3)
                    💡
                @break
                @case(4)
                    📝
                @break
                @default
                    ✨
            @endswitch
        </div>
    </div>
    
    {{-- Content --}}
    <div class="p-6">
        <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:{{ $color['text'] }} transition-colors duration-300">
            {{ $pillar->name }}
        </h3>
        <p class="text-slate-600 text-sm line-clamp-2 mb-4 leading-relaxed">
            {{ $pillar->description }}
        </p>
        
        {{ $slot }}
    </div>
</div>
