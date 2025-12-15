{{-- Reusable Hero Section Component --}}
<section class="relative w-full py-20 lg:py-28 overflow-hidden bg-mesh flex items-center">
    {{-- Blob Shapes --}}
    <div class="blob-shape blob-1"></div>
    <div class="blob-shape blob-2"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="fade-in-up">
            {{-- Badge --}}
            @if(isset($badge))
                <div class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-indigo-100 to-purple-100 border border-indigo-200 mb-6 backdrop-blur-sm hover:shadow-lg transition-shadow">
                    <span class="text-indigo-600 text-sm font-bold tracking-widest">{{ $badge }}</span>
                </div>
            @endif

            {{-- Title --}}
            <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900 leading-tight mb-4 tracking-tight">
                @if(isset($titleHighlight))
                    @php
                        $parts = explode($titleHighlight, $title);
                    @endphp
                    {{ $parts[0] }}<span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600">{{ $titleHighlight }}</span>{{ $parts[1] ?? '' }}
                @else
                    {{ $title }}
                @endif
            </h1>

            {{-- Description --}}
            @if(isset($description))
                <p class="text-lg text-slate-600 max-w-2xl leading-relaxed">
                    {{ $description }}
                </p>
            @endif

            {{-- Breadcrumb --}}
            @if(isset($breadcrumb) && is_array($breadcrumb))
                <div class="flex items-center gap-2 mt-6 text-sm text-slate-600">
                    @foreach($breadcrumb as $index => $item)
                        @if($index > 0)
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        @endif
                        @if(isset($item['url']))
                            <a href="{{ $item['url'] }}" class="text-indigo-600 hover:text-indigo-600 font-medium">{{ $item['name'] }}</a>
                        @else
                            <span class="text-slate-900 font-medium">{{ $item['name'] }}</span>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
