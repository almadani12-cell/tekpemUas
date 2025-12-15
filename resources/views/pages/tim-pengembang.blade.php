<x-learning-layout>
    @php $title = 'Tim Pengembang'; @endphp

    {{-- Hero Section --}}
    <x-page-hero 
        :title="' ' . ''"
        titleHighlight="Tim Pengembang"
        description="Kenali tim di balik Media Pembelajaran Berpikir Komputasional yang inovatif dan berdedikasi"
        :breadcrumb="[
            ['name' => 'Dashboard', 'url' => route('dashboard')],
            ['name' => 'Tim Pengembang']
        ]"
    />

    {{-- Team Grid --}}
    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Single Developer Card - Centered --}}
            <div class="flex justify-center mb-12">
                @foreach($team as $index => $member)
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden card-hover fade-in-up w-full max-w-sm shadow-lg">
                        {{-- Photo --}}
                        <div class="aspect-square bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 relative overflow-hidden">
                            <img 
                                src="{{ $member['image'] }}" 
                                alt="{{ $member['name'] }}" 
                                class="w-full h-full object-cover"
                            >
                        </div>
                        
                        {{-- Info --}}
                        <div class="p-8 text-center">
                            <h3 class="text-2xl font-bold text-slate-900 mb-2">{{ $member['name'] }}</h3>
                            <p class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 font-bold text-base mb-4">{{ $member['role'] }}</p>
                            <p class="text-slate-600 text-base leading-relaxed">{{ $member['bio'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- About Section --}}
            <div class="mt-16 bg-white rounded-2xl border border-slate-200 p-8 md:p-12">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-4">Tentang Proyek Ini</h2>
                    <p class="text-slate-600 leading-relaxed mb-6">
                        Media Pembelajaran Berpikir Komputasional ini dikembangkan sebagai inovasi dalam pembelajaran Informatika untuk siswa SMK Kelas X. Dengan pendekatan kontekstual learning, kami bertujuan untuk membuat konsep berpikir komputasional lebih mudah dipahami dan diterapkan dalam kehidupan sehari-hari.
                    </p>
                    <p class="text-slate-600 leading-relaxed">
                        Proyek ini mencakup 4 pilar utama berpikir komputasional: Dekomposisi, Pengenalan Pola, Abstraksi, dan Algoritma. Setiap pilar dilengkapi dengan materi teks, video pembelajaran, dan quiz interaktif untuk mengukur pemahaman siswa.
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-learning-layout>
