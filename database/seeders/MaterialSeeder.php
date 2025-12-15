<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Pillar;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pillars = Pillar::all();

        foreach ($pillars as $pillar) {
            // Text materials
            $this->createTextMaterials($pillar);

            // Video materials
            $this->createVideoMaterials($pillar);
        }
    }

    private function createTextMaterials(Pillar $pillar): void
    {
        $materials = [
            [
                'title' => 'Pengertian ' . $pillar->name,
                'type' => 'text',
                'content' => $this->getIntroContent($pillar),
                'order' => 1,
            ],
            [
                'title' => 'Contoh Penerapan ' . $pillar->name,
                'type' => 'text',
                'content' => $this->getExampleContent($pillar),
                'order' => 2,
            ],
            [
                'title' => 'Latihan ' . $pillar->name,
                'type' => 'text',
                'content' => $this->getPracticeContent($pillar),
                'order' => 3,
            ],
        ];

        foreach ($materials as $material) {
            $pillar->materials()->create($material);
        }
    }

    private function createVideoMaterials(Pillar $pillar): void
    {
        $materials = [
            [
                'title' => 'Video Penjelasan ' . $pillar->name,
                'type' => 'video',
                'content' => '<p>Tonton video berikut untuk memahami konsep ' . $pillar->name . ' secara lebih mendalam.</p>',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', // Placeholder
                'order' => 1,
            ],
            [
                'title' => 'Video Contoh Kasus ' . $pillar->name,
                'type' => 'video',
                'content' => '<p>Video ini menunjukkan contoh penerapan ' . $pillar->name . ' dalam kehidupan sehari-hari.</p>',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', // Placeholder
                'order' => 2,
            ],
        ];

        foreach ($materials as $material) {
            $pillar->materials()->create($material);
        }
    }

    private function getIntroContent(Pillar $pillar): string
    {
        $contents = [
            'dekomposisi' => '
                <h2 class="text-2xl font-bold mb-4">Apa itu Dekomposisi?</h2>
                <p class="mb-4">Dekomposisi adalah salah satu pilar fundamental dalam berpikir komputasional. Konsep ini melibatkan pemecahan masalah kompleks menjadi bagian-bagian yang lebih kecil dan mudah dikelola.</p>
                
                <h3 class="text-xl font-semibold mb-3">Mengapa Dekomposisi Penting?</h3>
                <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
                
                <h3 class="text-xl font-semibold mb-3">Karakteristik Dekomposisi</h3>
                <ul class="list-disc list-inside mb-4 space-y-2">
                    <li>Memecah masalah besar menjadi sub-masalah yang lebih kecil</li>
                    <li>Setiap bagian dapat diselesaikan secara independen</li>
                    <li>Hasil dari setiap bagian dapat digabungkan menjadi solusi lengkap</li>
                    <li>Memudahkan pengelolaan dan debugging</li>
                </ul>
                
                <div class="bg-indigo-50 border-l-4 border-indigo-500 p-4 my-4">
                    <p class="font-semibold text-indigo-600">💡 Tips:</p>
                    <p class="text-indigo-600">Mulailah dengan mengidentifikasi komponen utama dari masalah, kemudian pecah setiap komponen menjadi langkah-langkah yang lebih spesifik.</p>
                </div>
            ',
            'pengenalan-pola' => '
                <h2 class="text-2xl font-bold mb-4">Apa itu Pengenalan Pola?</h2>
                <p class="mb-4">Pengenalan pola adalah kemampuan untuk mengidentifikasi kesamaan, tren, atau pola yang berulang dalam data atau masalah. Kemampuan ini sangat penting dalam berpikir komputasional.</p>
                
                <h3 class="text-xl font-semibold mb-3">Mengapa Pengenalan Pola Penting?</h3>
                <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit in voluptate.</p>
                
                <h3 class="text-xl font-semibold mb-3">Jenis-jenis Pola</h3>
                <ul class="list-disc list-inside mb-4 space-y-2">
                    <li>Pola berulang (repetitive patterns)</li>
                    <li>Pola sekuensial (sequential patterns)</li>
                    <li>Pola struktural (structural patterns)</li>
                    <li>Pola perilaku (behavioral patterns)</li>
                </ul>
                
                <div class="bg-teal-50 border-l-4 border-teal-500 p-4 my-4">
                    <p class="font-semibold text-teal-700">💡 Tips:</p>
                    <p class="text-teal-600">Latih kemampuan observasi Anda dengan mencari kesamaan dalam berbagai situasi sehari-hari.</p>
                </div>
            ',
            'abstraksi' => '
                <h2 class="text-2xl font-bold mb-4">Apa itu Abstraksi?</h2>
                <p class="mb-4">Abstraksi adalah proses menyaring informasi yang tidak relevan dan fokus pada detail yang penting. Ini membantu menyederhanakan masalah kompleks menjadi representasi yang lebih mudah dipahami.</p>
                
                <h3 class="text-xl font-semibold mb-3">Mengapa Abstraksi Penting?</h3>
                <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                
                <h3 class="text-xl font-semibold mb-3">Tingkatan Abstraksi</h3>
                <ul class="list-disc list-inside mb-4 space-y-2">
                    <li>Abstraksi data - menyembunyikan detail implementasi data</li>
                    <li>Abstraksi prosedural - menyembunyikan detail proses</li>
                    <li>Abstraksi kontrol - menyembunyikan alur kontrol program</li>
                </ul>
                
                <div class="bg-amber-50 border-l-4 border-amber-500 p-4 my-4">
                    <p class="font-semibold text-amber-700">💡 Tips:</p>
                    <p class="text-amber-600">Tanyakan pada diri sendiri: "Informasi apa yang benar-benar penting untuk menyelesaikan masalah ini?"</p>
                </div>
            ',
            'algoritma' => '
                <h2 class="text-2xl font-bold mb-4">Apa itu Algoritma?</h2>
                <p class="mb-4">Algoritma adalah serangkaian instruksi atau langkah-langkah yang terstruktur dan sistematis untuk menyelesaikan suatu masalah atau mencapai tujuan tertentu.</p>
                
                <h3 class="text-xl font-semibold mb-3">Mengapa Algoritma Penting?</h3>
                <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
                
                <h3 class="text-xl font-semibold mb-3">Karakteristik Algoritma yang Baik</h3>
                <ul class="list-disc list-inside mb-4 space-y-2">
                    <li>Memiliki input dan output yang jelas</li>
                    <li>Langkah-langkah yang definitif dan tidak ambigu</li>
                    <li>Terbatas (finite) - harus berakhir setelah sejumlah langkah</li>
                    <li>Efektif - setiap langkah dapat dilaksanakan</li>
                </ul>
                
                <div class="bg-rose-50 border-l-4 border-rose-500 p-4 my-4">
                    <p class="font-semibold text-rose-700">💡 Tips:</p>
                    <p class="text-rose-600">Mulailah dengan pseudocode sebelum menulis kode program untuk memastikan logika Anda benar.</p>
                </div>
            ',
        ];

        return $contents[$pillar->slug] ?? '<p>Konten belum tersedia.</p>';
    }

    private function getExampleContent(Pillar $pillar): string
    {
        $contents = [
            'dekomposisi' => '
                <h2 class="text-2xl font-bold mb-4">Contoh Penerapan Dekomposisi</h2>
                
                <h3 class="text-xl font-semibold mb-3">Contoh 1: Membuat Nasi Goreng</h3>
                <p class="mb-4">Mari kita pecah proses membuat nasi goreng menjadi langkah-langkah yang lebih kecil:</p>
                <ol class="list-decimal list-inside mb-4 space-y-2">
                    <li>Menyiapkan bahan-bahan (nasi, telur, bumbu, sayuran)</li>
                    <li>Menyiapkan peralatan (wajan, spatula, kompor)</li>
                    <li>Mengolah bumbu</li>
                    <li>Memasak telur</li>
                    <li>Menumis bumbu</li>
                    <li>Menambahkan nasi dan sayuran</li>
                    <li>Penyajian</li>
                </ol>
                
                <h3 class="text-xl font-semibold mb-3">Contoh 2: Mengerjakan Proyek Sekolah</h3>
                <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae.</p>
                <ul class="list-disc list-inside mb-4 space-y-2">
                    <li>Memahami tugas dan requirements</li>
                    <li>Riset dan pengumpulan data</li>
                    <li>Membuat outline</li>
                    <li>Menulis draft pertama</li>
                    <li>Review dan revisi</li>
                    <li>Finalisasi dan submit</li>
                </ul>
            ',
            'pengenalan-pola' => '
                <h2 class="text-2xl font-bold mb-4">Contoh Penerapan Pengenalan Pola</h2>
                
                <h3 class="text-xl font-semibold mb-3">Contoh 1: Pola Bilangan</h3>
                <p class="mb-4">Temukan pola dalam deret berikut:</p>
                <p class="font-mono bg-gray-100 p-3 rounded mb-4">2, 4, 6, 8, 10, ...</p>
                <p class="mb-4">Pola: Setiap bilangan bertambah 2 dari bilangan sebelumnya.</p>
                
                <h3 class="text-xl font-semibold mb-3">Contoh 2: Jadwal Kegiatan Harian</h3>
                <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
                <div class="overflow-x-auto">
                    <table class="min-w-full border mb-4">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border p-2">Hari</th>
                                <th class="border p-2">Kegiatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td class="border p-2">Senin</td><td class="border p-2">Olahraga</td></tr>
                            <tr><td class="border p-2">Selasa</td><td class="border p-2">Belajar</td></tr>
                            <tr><td class="border p-2">Rabu</td><td class="border p-2">Olahraga</td></tr>
                            <tr><td class="border p-2">Kamis</td><td class="border p-2">Belajar</td></tr>
                        </tbody>
                    </table>
                </div>
                <p class="mb-4">Pola: Kegiatan bergantian antara Olahraga dan Belajar.</p>
            ',
            'abstraksi' => '
                <h2 class="text-2xl font-bold mb-4">Contoh Penerapan Abstraksi</h2>
                
                <h3 class="text-xl font-semibold mb-3">Contoh 1: Peta Kota</h3>
                <p class="mb-4">Peta adalah contoh abstraksi. Peta tidak menunjukkan setiap detail kota, tetapi hanya informasi yang relevan seperti:</p>
                <ul class="list-disc list-inside mb-4 space-y-2">
                    <li>Jalan utama dan persimpangan</li>
                    <li>Landmark penting</li>
                    <li>Skala dan arah</li>
                </ul>
                <p class="mb-4">Detail yang diabaikan: bentuk bangunan, pepohonan, pejalan kaki, dll.</p>
                
                <h3 class="text-xl font-semibold mb-3">Contoh 2: Buku Telepon</h3>
                <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo.</p>
                <p class="mb-4">Informasi yang relevan: Nama, Nomor telepon</p>
                <p class="mb-4">Informasi yang diabaikan: Alamat lengkap, foto, hobi, dll.</p>
            ',
            'algoritma' => '
                <h2 class="text-2xl font-bold mb-4">Contoh Penerapan Algoritma</h2>
                
                <h3 class="text-xl font-semibold mb-3">Contoh 1: Algoritma Menyeberang Jalan</h3>
                <ol class="list-decimal list-inside mb-4 space-y-2">
                    <li>Berdiri di tepi jalan</li>
                    <li>Lihat ke kiri</li>
                    <li>Lihat ke kanan</li>
                    <li>Jika ada kendaraan, TUNGGU dan ulangi langkah 2-3</li>
                    <li>Jika tidak ada kendaraan, JALAN dengan cepat</li>
                    <li>Sampai di seberang jalan</li>
                </ol>
                
                <h3 class="text-xl font-semibold mb-3">Contoh 2: Flowchart Menentukan Bilangan Ganjil/Genap</h3>
                <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
                <div class="bg-gray-100 p-4 rounded font-mono text-sm mb-4">
                    <p>MULAI</p>
                    <p>INPUT bilangan n</p>
                    <p>JIKA n MOD 2 = 0 MAKA</p>
                    <p>&nbsp;&nbsp;OUTPUT "Bilangan Genap"</p>
                    <p>LAINNYA</p>
                    <p>&nbsp;&nbsp;OUTPUT "Bilangan Ganjil"</p>
                    <p>SELESAI</p>
                </div>
            ',
        ];

        return $contents[$pillar->slug] ?? '<p>Konten belum tersedia.</p>';
    }

    private function getPracticeContent(Pillar $pillar): string
    {
        return '
            <h2 class="text-2xl font-bold mb-4">Latihan ' . $pillar->name . '</h2>
            
            <div class="bg-gray-50 p-6 rounded-lg mb-6">
                <h3 class="text-xl font-semibold mb-3">Soal Latihan 1</h3>
                <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <p class="text-gray-600 italic">Petunjuk: Coba terapkan konsep ' . $pillar->name . ' untuk menyelesaikan masalah di atas.</p>
            </div>
            
            <div class="bg-gray-50 p-6 rounded-lg mb-6">
                <h3 class="text-xl font-semibold mb-3">Soal Latihan 2</h3>
                <p class="mb-4">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae. Donec velit neque, auctor sit amet aliquam vel.</p>
                <p class="text-gray-600 italic">Petunjuk: Identifikasi bagian-bagian penting dari masalah ini.</p>
            </div>
            
            <div class="bg-gray-50 p-6 rounded-lg mb-6">
                <h3 class="text-xl font-semibold mb-3">Soal Latihan 3</h3>
                <p class="mb-4">Curabitur aliquet quam id dui posuere blandit. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.</p>
                <p class="text-gray-600 italic">Petunjuk: Gunakan pendekatan sistematis dalam menyelesaikan soal ini.</p>
            </div>
            
            <div class="mt-8 p-4 bg-' . $this->getColorClass($pillar->color) . '-100 rounded-lg">
                <p class="font-semibold text-' . $this->getColorClass($pillar->color) . '-700">🎯 Setelah selesai latihan:</p>
                <p class="text-' . $this->getColorClass($pillar->color) . '-600">Lanjutkan ke halaman Evaluasi untuk mengerjakan kuis dan mengukur pemahaman Anda tentang ' . $pillar->name . '!</p>
            </div>
        ';
    }

    private function getColorClass(string $color): string
    {
        return match($color) {
            'indigo' => 'indigo',
            'teal' => 'teal',
            'amber' => 'amber',
            'rose' => 'rose',
            default => 'blue',
        };
    }
}
