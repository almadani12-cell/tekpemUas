<x-learning-layout>
    @php $title = 'CP & TP'; @endphp

    {{-- Hero Section --}}
    <x-page-hero 
        title="Capaian & Tujuan"
        titleHighlight="Pembelajaran"
        badge="🎯 PEMBELAJARAN INTI"
        description="Kompetensi yang harus dicapai dalam materi Berpikir Komputasional"
        :breadcrumb="[
            ['name' => 'Dashboard', 'url' => route('dashboard')],
            ['name' => 'Materi', 'url' => route('materi.index')],
            ['name' => 'CP & TP']
        ]"
    />

    {{-- Content --}}
    <section class="py-12 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Capaian Pembelajaran --}}
            <div class="bg-white rounded-2xl border border-slate-200 p-8 mb-8 fade-in-up">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 bg-amber-100 rounded-xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">Capaian Pembelajaran (CP)</h2>
                        <p class="text-slate-600">Kurikulum Merdeka - Fase E (Kelas X) - Berpikir Komputasional</p>
                    </div>
                </div>

                <div class="prose prose-slate max-w-none">
                    <p class="text-lg text-slate-700 leading-relaxed">
                        Pada akhir fase E, peserta didik mampu menerapkan strategi algoritmik standar untuk menghasilkan beberapa solusi persoalan dengan data diskrit bervolume tidak kecil pada kehidupan sehari-hari maupun implementasinya dalam program komputer.
                    </p>
                </div>

                <div class="mt-6 p-4 bg-amber-50 rounded-xl border border-amber-200">
                    <h4 class="font-bold text-amber-800 mb-2">Elemen Capaian:</h4>
                    <ul class="space-y-2 text-amber-900">
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-amber-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span><strong>Strategi Algoritmik Standar:</strong> Mampu menerapkan pola penyelesaian masalah sistematis seperti dekomposisi, pencarian, dan pengurutan</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-amber-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span><strong>Data Diskrit Bervolume Tidak Kecil:</strong> Mampu bekerja dengan data dalam jumlah banyak, terpisah, dan cukup besar</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-amber-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span><strong>Kehidupan Sehari-hari & Program Komputer:</strong> Mampu mengimplementasikan solusi dalam konteks nyata dan programing</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Tujuan Pembelajaran per Pilar --}}
            <h2 class="text-2xl font-bold text-slate-900 mb-6 fade-in-up delay-100">Tujuan Pembelajaran (TP) per Pilar</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($pillars as $index => $pillar)
                    @php
                        $colorClasses = [
                            'indigo' => ['bg' => 'bg-indigo-500', 'light' => 'bg-indigo-50', 'border' => 'border-indigo-200', 'text' => 'text-indigo-600'],
                            'teal' => ['bg' => 'bg-teal-500', 'light' => 'bg-teal-50', 'border' => 'border-teal-200', 'text' => 'text-teal-600'],
                            'amber' => ['bg' => 'bg-amber-500', 'light' => 'bg-amber-50', 'border' => 'border-amber-200', 'text' => 'text-amber-600'],
                            'rose' => ['bg' => 'bg-rose-500', 'light' => 'bg-rose-50', 'border' => 'border-rose-200', 'text' => 'text-rose-600'],
                        ];
                        $color = $colorClasses[$pillar->color] ?? $colorClasses['indigo'];
                        
                        $tujuanPembelajaran = [
                            'dekomposisi' => [
                                'Memahami konsep dekomposisi sebagai strategi pemecahan masalah kompleks menjadi bagian-bagian sistematis',
                                'Mengidentifikasi sub-masalah dari permasalahan dengan data diskrit bervolume tidak kecil',
                                'Menerapkan teknik dekomposisi dalam konteks kehidupan sehari-hari dan implementasi program',
                            ],
                            'pengenalan-pola' => [
                                'Memahami konsep pengenalan pola sebagai strategi identifikasi keteraturan dalam data diskrit',
                                'Mengidentifikasi kesamaan dan perbedaan dalam data atau permasalahan bervolume tidak kecil',
                                'Menggunakan pola yang ditemukan untuk menghasilkan solusi yang efisien',
                            ],
                            'abstraksi' => [
                                'Memahami konsep abstraksi sebagai strategi penyederhanaan data dan masalah kompleks',
                                'Mengidentifikasi informasi penting dan mengabaikan detail yang tidak relevan dari data diskrit',
                                'Membuat model atau representasi sederhana untuk implementasi solusi',
                            ],
                            'algoritma' => [
                                'Memahami konsep algoritma sebagai strategi algoritmik standar dengan langkah-langkah terstruktur',
                                'Merancang algoritma untuk menyelesaikan permasalahan dengan data diskrit bervolume tidak kecil',
                                'Mengevaluasi dan mengimplementasikan algoritma dalam bentuk pseudocode',
                            ],
                        ];
                    @endphp
                    
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden fade-in-up delay-{{ ($index + 2) * 100 }}">
                        <div class="h-3 {{ $color['bg'] }}"></div>
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="text-3xl">
                                    @switch($pillar->slug)
                                        @case('dekomposisi') 🧩 @break
                                        @case('pengenalan-pola') 🔍 @break
                                        @case('abstraksi') 💡 @break
                                        @case('algoritma') 📝 @break
                                    @endswitch
                                </span>
                                <h3 class="text-xl font-bold text-slate-900">{{ $pillar->name }}</h3>
                            </div>
                            
                            <ul class="space-y-3">
                                @foreach($tujuanPembelajaran[$pillar->slug] ?? [] as $tp)
                                    <li class="flex items-start gap-2">
                                        <svg class="w-5 h-5 {{ $color['text'] }} mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-slate-600">{{ $tp }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            
                            <div class="mt-4 pt-4 border-t border-slate-100">
                                <a href="{{ route('materi.show', ['pillar' => $pillar->slug, 'type' => 'text']) }}" class="inline-flex items-center text-sm font-semibold {{ $color['text'] }} hover:underline">
                                    Pelajari Materi
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Back Button --}}
            <div class="mt-12 text-center">
                <a href="{{ route('materi.index') }}" class="inline-flex items-center px-6 py-3 border-2 border-slate-200 text-slate-600 font-bold rounded-xl hover:border-slate-300 hover:bg-white transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Pilihan Materi
                </a>
            </div>
        </div>
    </section>
</x-learning-layout>
