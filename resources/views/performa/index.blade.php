<x-learning-layout>
    @php $title = 'Performa'; @endphp

    {{-- Hero Section --}}
    <x-page-hero 
        :title="' ' . ''"
        titleHighlight="Performa Belajar"
        description="Pantau progres dan tingkat penguasaanmu di setiap pilar berpikir komputasional"
        :breadcrumb="[
            ['name' => 'Dashboard', 'url' => route('dashboard')],
            ['name' => 'Performa']
        ]"
    />

    {{-- Stats Overview --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20 mb-12">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <x-stat-card 
                :value="$overallStats['total_attempts']" 
                label="Total Quiz Dikerjakan"
                color="indigo"
                icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>'
            />
            <x-stat-card 
                :value="round($overallStats['average_score'])" 
                label="Rata-rata Nilai"
                suffix="%"
                color="teal"
                icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>'
            />
            <x-stat-card 
                :value="$overallStats['pillars_mastered']" 
                label="Pilar Dikuasai"
                suffix="/{{ $overallStats['total_pillars'] }}"
                color="amber"
                icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>'
            />
            <x-stat-card 
                :value="round(($overallStats['pillars_mastered'] / max($overallStats['total_pillars'], 1)) * 100)" 
                label="Tingkat Penyelesaian"
                suffix="%"
                color="rose"
                icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>'
            />
        </div>
    </section>

    {{-- Charts and Performance --}}
    <section class="py-8 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Chart --}}
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 p-6">
                    <h3 class="text-xl font-bold text-slate-900 mb-6">Grafik Progres per Pilar</h3>
                    <div class="h-80">
                        <canvas id="performanceChart"></canvas>
                    </div>
                </div>

                {{-- Pillar Performance Cards --}}
                <div class="space-y-4">
                    <h3 class="text-xl font-bold text-slate-900 mb-4">Detail per Pilar</h3>
                    @foreach($performanceData as $data)
                        @php
                            $pillar = $data['pillar'];
                            $colorClasses = [
                                'indigo' => ['bg' => 'bg-indigo-500', 'light' => 'bg-indigo-50', 'text' => 'text-indigo-600', 'border' => 'border-l-indigo-500'],
                                'teal' => ['bg' => 'bg-teal-500', 'light' => 'bg-teal-50', 'text' => 'text-teal-600', 'border' => 'border-l-teal-500'],
                                'amber' => ['bg' => 'bg-amber-500', 'light' => 'bg-amber-50', 'text' => 'text-amber-600', 'border' => 'border-l-amber-500'],
                                'rose' => ['bg' => 'bg-rose-500', 'light' => 'bg-rose-50', 'text' => 'text-rose-600', 'border' => 'border-l-rose-500'],
                            ];
                            $color = $colorClasses[$pillar->color] ?? $colorClasses['indigo'];
                        @endphp
                        <div class="bg-white rounded-xl border border-slate-200 border-l-4 {{ $color['border'] }} p-4 card-hover">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="text-xl">
                                        @switch($pillar->slug)
                                            @case('dekomposisi') 🧩 @break
                                            @case('pengenalan-pola') 🔍 @break
                                            @case('abstraksi') 💡 @break
                                            @case('algoritma') 📝 @break
                                        @endswitch
                                    </span>
                                    <span class="font-bold text-slate-900">{{ $pillar->name }}</span>
                                </div>
                                <span class="text-2xl font-extrabold {{ $data['best_score'] > 70 ? 'text-green-600' : ($data['best_score'] > 0 ? 'text-amber-600' : 'text-slate-400') }}">
                                    {{ $data['best_score'] }}%
                                </span>
                            </div>
                            
                            {{-- Progress Bar --}}
                            <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden mb-2">
                                <div class="h-full {{ $color['bg'] }} rounded-full progress-bar" style="width: {{ $data['best_score'] }}%"></div>
                            </div>
                            
                            <div class="flex items-center justify-between text-xs">
                                <span class="{{ $data['best_score'] > 70 ? 'text-green-600' : ($data['best_score'] > 0 ? 'text-amber-600' : 'text-slate-500') }} font-medium">
                                    {{ $data['mastery_level'] }}
                                </span>
                                <span class="text-slate-500">{{ $data['attempt_count'] }}x percobaan</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Suggestions Section --}}
    <section class="py-8 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-xl font-bold text-slate-900 mb-6">Saran untuk Meningkatkan Pemahaman</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($performanceData as $data)
                    @php
                        $pillar = $data['pillar'];
                        $colorClasses = [
                            'indigo' => ['light' => 'bg-indigo-50', 'text' => 'text-indigo-600', 'border' => 'border-indigo-200'],
                            'teal' => ['light' => 'bg-teal-50', 'text' => 'text-teal-600', 'border' => 'border-teal-200'],
                            'amber' => ['light' => 'bg-amber-50', 'text' => 'text-amber-600', 'border' => 'border-amber-200'],
                            'rose' => ['light' => 'bg-rose-50', 'text' => 'text-rose-600', 'border' => 'border-rose-200'],
                        ];
                        $color = $colorClasses[$pillar->color] ?? $colorClasses['indigo'];
                    @endphp
                    <div class="{{ $color['light'] }} border {{ $color['border'] }} rounded-xl p-5">
                        <div class="flex items-start gap-4">
                            <span class="text-3xl">
                                @switch($pillar->slug)
                                    @case('dekomposisi') 🧩 @break
                                    @case('pengenalan-pola') 🔍 @break
                                    @case('abstraksi') 💡 @break
                                    @case('algoritma') 📝 @break
                                @endswitch
                            </span>
                            <div class="flex-1">
                                <h4 class="font-bold text-slate-900 mb-1">{{ $pillar->name }}</h4>
                                <p class="text-sm text-slate-600 mb-3">{{ $data['suggestion'] }}</p>
                                <div class="flex gap-2">
                                    <a href="{{ route('materi.show', ['pillar' => $pillar->slug, 'type' => 'text']) }}" class="text-xs font-medium {{ $color['text'] }} hover:underline">
                                        📖 Baca Materi
                                    </a>
                                    <span class="text-slate-300">|</span>
                                    <a href="{{ route('evaluasi.start', $pillar) }}" class="text-xs font-medium {{ $color['text'] }} hover:underline">
                                        📝 Kerjakan Quiz
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- History Section --}}
    @if($recentHistory->isNotEmpty())
        <section class="py-8 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h3 class="text-xl font-bold text-slate-900 mb-6">Riwayat Quiz Terakhir</h3>
                
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Pilar</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-slate-600 uppercase tracking-wider">Benar/Total</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-slate-600 uppercase tracking-wider">Nilai</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-slate-600 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($recentHistory as $attempt)
                                @php
                                    $pillar = $attempt->quiz->pillar;
                                @endphp
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <span class="text-lg">
                                                @switch($pillar->slug)
                                                    @case('dekomposisi') 🧩 @break
                                                    @case('pengenalan-pola') 🔍 @break
                                                    @case('abstraksi') 💡 @break
                                                    @case('algoritma') 📝 @break
                                                @endswitch
                                            </span>
                                            <span class="font-medium text-slate-900">{{ $pillar->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600">
                                        {{ $attempt->completed_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm text-slate-600">
                                        {{ $attempt->correct_answers }}/{{ $attempt->total_questions }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-lg font-bold {{ $attempt->score > 70 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $attempt->score }}%
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($attempt->score > 70)
                                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Lulus</span>
                                        @else
                                            <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">Belum Lulus</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    @endif

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('performanceChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Nilai Terbaik (%)',
                        data: @json($chartScores),
                        backgroundColor: @json($chartColors),
                        borderColor: @json($chartColors),
                        borderWidth: 1,
                        borderRadius: 8,
                        barThickness: 60,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            titleFont: { size: 14, weight: 'bold' },
                            bodyFont: { size: 13 },
                            padding: 12,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    return `Nilai: ${context.parsed.y}%`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                callback: function(value) {
                                    return value + '%';
                                }
                            },
                            grid: {
                                color: '#f1f5f9'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-learning-layout>
