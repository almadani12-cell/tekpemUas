<x-learning-layout>
    @php $title = 'Sumber Referensi'; @endphp

    {{-- Hero Section --}}
    <x-page-hero 
        :title="' ' . ''"
        titleHighlight="Sumber Referensi"
        description="Daftar lengkap sumber referensi yang digunakan dalam pengembangan materi pembelajaran"
        :breadcrumb="[
            ['name' => 'Dashboard', 'url' => route('dashboard')],
            ['name' => 'Sumber Referensi']
        ]"
    />

    {{-- Content --}}
    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- Text Sources --}}
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-900">Sumber Teks</h2>
                    </div>

                    <div class="space-y-4">
                        @foreach($sources['text'] as $index => $source)
                            <div class="bg-white rounded-xl border border-slate-200 p-6 card-hover fade-in-up delay-{{ ($index + 1) * 100 }}">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 bg-indigo-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <span class="text-indigo-600 font-bold">{{ $index + 1 }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-bold text-slate-900 mb-1">{{ $source['title'] }}</h3>
                                        <p class="text-sm text-indigo-600 mb-2">{{ $source['author'] }} ({{ $source['year'] }})</p>
                                        <p class="text-sm text-slate-600 mb-3">{{ $source['description'] }}</p>
                                        @if(isset($source['url']))
                                            <a href="{{ $source['url'] }}" target="_blank" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                </svg>
                                                Kunjungi Link
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Video Sources --}}
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-900">Sumber Video</h2>
                    </div>

                    <div class="space-y-4">
                        @foreach($sources['video'] as $index => $source)
                            <div class="bg-white rounded-xl border border-slate-200 p-6 card-hover fade-in-up delay-{{ ($index + 2) * 100 }}">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 bg-teal-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-teal-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-bold text-slate-900 mb-1">{{ $source['title'] }}</h3>
                                        <p class="text-sm text-teal-600 mb-2">{{ $source['channel'] }}</p>
                                        <p class="text-sm text-slate-600 mb-3">{{ $source['description'] }}</p>
                                        <a href="{{ $source['url'] }}" target="_blank" class="inline-flex items-center text-sm font-medium text-teal-600 hover:text-teal-700">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                            Kunjungi Link
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Citation Note --}}
            <div class="mt-12 bg-amber-50 border border-amber-200 rounded-2xl p-6">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-amber-800 mb-1">Catatan Pengutipan</h3>
                        <p class="text-sm text-amber-700">
                            Semua materi dalam media pembelajaran ini telah diadaptasi dan dikembangkan berdasarkan sumber-sumber referensi di atas. Konten telah disesuaikan untuk kebutuhan pembelajaran siswa SMK Kelas X dengan pendekatan kontekstual.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-learning-layout>
