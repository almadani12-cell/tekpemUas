<?php

namespace Database\Seeders;

use App\Models\Pillar;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pillars = Pillar::all();

        foreach ($pillars as $pillar) {
            $quiz = Quiz::create([
                'pillar_id' => $pillar->id,
                'title' => 'Kuis ' . $pillar->name,
                'description' => 'Kuis untuk menguji pemahaman Anda tentang konsep ' . $pillar->name . ' dalam berpikir komputasional.',
                'is_active' => true,
            ]);

            // Create 3 multiple choice questions
            $this->createMultipleChoiceQuestions($quiz, $pillar);

            // Create 3 drag and drop questions
            $this->createDragDropQuestions($quiz, $pillar);
        }
    }

    private function createMultipleChoiceQuestions(Quiz $quiz, Pillar $pillar): void
    {
        $questions = $this->getMultipleChoiceData($pillar);

        foreach ($questions as $index => $questionData) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'type' => 'multiple_choice',
                'content' => $questionData['content'],
                'order' => $index + 1,
            ]);

            foreach ($questionData['options'] as $optIndex => $option) {
                $question->options()->create([
                    'content' => $option['content'],
                    'is_correct' => $option['is_correct'],
                    'order' => $optIndex + 1,
                ]);
            }
        }
    }

    private function createDragDropQuestions(Quiz $quiz, Pillar $pillar): void
    {
        $questions = $this->getDragDropData($pillar);

        foreach ($questions as $index => $questionData) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'type' => 'drag_drop',
                'content' => $questionData['content'],
                'order' => $index + 4, // After MC questions
            ]);

            foreach ($questionData['options'] as $optIndex => $option) {
                $question->options()->create([
                    'content' => $option,
                    'is_correct' => true, // For drag-drop, order matters
                    'order' => $optIndex + 1, // This is the correct order
                ]);
            }
        }
    }

    private function getMultipleChoiceData(Pillar $pillar): array
    {
        $data = [
            'dekomposisi' => [
                [
                    'content' => 'Apa yang dimaksud dengan dekomposisi dalam berpikir komputasional?',
                    'options' => [
                        ['content' => 'Proses menggabungkan beberapa masalah menjadi satu', 'is_correct' => false],
                        ['content' => 'Proses memecah masalah kompleks menjadi bagian-bagian yang lebih kecil', 'is_correct' => true],
                        ['content' => 'Proses mengabaikan masalah yang sulit', 'is_correct' => false],
                        ['content' => 'Proses membuat masalah menjadi lebih kompleks', 'is_correct' => false],
                    ],
                ],
                [
                    'content' => 'Manakah contoh penerapan dekomposisi dalam kehidupan sehari-hari?',
                    'options' => [
                        ['content' => 'Membagi tugas besar menjadi langkah-langkah kecil', 'is_correct' => true],
                        ['content' => 'Mengerjakan semua tugas sekaligus', 'is_correct' => false],
                        ['content' => 'Mengabaikan tugas yang sulit', 'is_correct' => false],
                        ['content' => 'Menunda semua pekerjaan', 'is_correct' => false],
                    ],
                ],
                [
                    'content' => 'Mengapa dekomposisi penting dalam pemecahan masalah?',
                    'options' => [
                        ['content' => 'Karena membuat masalah lebih rumit', 'is_correct' => false],
                        ['content' => 'Karena menghindari masalah sepenuhnya', 'is_correct' => false],
                        ['content' => 'Karena memudahkan pengelolaan dan penyelesaian masalah secara sistematis', 'is_correct' => true],
                        ['content' => 'Karena memperlambat proses penyelesaian', 'is_correct' => false],
                    ],
                ],
            ],
            'pengenalan-pola' => [
                [
                    'content' => 'Apa tujuan utama dari pengenalan pola dalam berpikir komputasional?',
                    'options' => [
                        ['content' => 'Membuat masalah baru', 'is_correct' => false],
                        ['content' => 'Menemukan kesamaan atau tren yang berulang', 'is_correct' => true],
                        ['content' => 'Mengabaikan semua data', 'is_correct' => false],
                        ['content' => 'Menghapus semua informasi', 'is_correct' => false],
                    ],
                ],
                [
                    'content' => 'Deret bilangan: 3, 6, 9, 12, ... Apa pola yang terbentuk?',
                    'options' => [
                        ['content' => 'Setiap bilangan dikurangi 3', 'is_correct' => false],
                        ['content' => 'Setiap bilangan ditambah 3', 'is_correct' => true],
                        ['content' => 'Setiap bilangan dikali 2', 'is_correct' => false],
                        ['content' => 'Tidak ada pola', 'is_correct' => false],
                    ],
                ],
                [
                    'content' => 'Manakah yang BUKAN merupakan contoh pengenalan pola?',
                    'options' => [
                        ['content' => 'Mengenali bahwa semua segitiga memiliki 3 sisi', 'is_correct' => false],
                        ['content' => 'Menemukan rumus dari deret bilangan', 'is_correct' => false],
                        ['content' => 'Membuat masalah secara acak tanpa struktur', 'is_correct' => true],
                        ['content' => 'Mengidentifikasi kesamaan dalam data cuaca', 'is_correct' => false],
                    ],
                ],
            ],
            'abstraksi' => [
                [
                    'content' => 'Apa yang dimaksud dengan abstraksi dalam berpikir komputasional?',
                    'options' => [
                        ['content' => 'Menambahkan semua detail yang mungkin', 'is_correct' => false],
                        ['content' => 'Menyaring informasi tidak penting dan fokus pada yang relevan', 'is_correct' => true],
                        ['content' => 'Membuat masalah lebih kompleks', 'is_correct' => false],
                        ['content' => 'Mengabaikan semua informasi', 'is_correct' => false],
                    ],
                ],
                [
                    'content' => 'Manakah contoh abstraksi yang tepat?',
                    'options' => [
                        ['content' => 'Peta kota yang menunjukkan semua detail bangunan', 'is_correct' => false],
                        ['content' => 'Peta kota yang hanya menunjukkan jalan utama dan landmark', 'is_correct' => true],
                        ['content' => 'Foto satelit tanpa filter', 'is_correct' => false],
                        ['content' => 'Daftar semua orang di kota', 'is_correct' => false],
                    ],
                ],
                [
                    'content' => 'Mengapa abstraksi penting dalam pemrograman?',
                    'options' => [
                        ['content' => 'Agar kode lebih panjang', 'is_correct' => false],
                        ['content' => 'Agar semua detail terlihat', 'is_correct' => false],
                        ['content' => 'Agar kompleksitas tersembunyi dan fokus pada fungsionalitas utama', 'is_correct' => true],
                        ['content' => 'Agar program tidak berjalan', 'is_correct' => false],
                    ],
                ],
            ],
            'algoritma' => [
                [
                    'content' => 'Apa yang dimaksud dengan algoritma?',
                    'options' => [
                        ['content' => 'Sekumpulan data acak', 'is_correct' => false],
                        ['content' => 'Langkah-langkah terstruktur untuk menyelesaikan masalah', 'is_correct' => true],
                        ['content' => 'Program komputer yang sudah jadi', 'is_correct' => false],
                        ['content' => 'Bahasa pemrograman', 'is_correct' => false],
                    ],
                ],
                [
                    'content' => 'Manakah karakteristik algoritma yang baik?',
                    'options' => [
                        ['content' => 'Langkah tidak jelas dan ambigu', 'is_correct' => false],
                        ['content' => 'Tidak pernah berakhir (infinite loop)', 'is_correct' => false],
                        ['content' => 'Memiliki input, proses, dan output yang jelas', 'is_correct' => true],
                        ['content' => 'Tidak memiliki urutan', 'is_correct' => false],
                    ],
                ],
                [
                    'content' => 'Manakah contoh algoritma dalam kehidupan sehari-hari?',
                    'options' => [
                        ['content' => 'Resep masakan dengan langkah-langkah jelas', 'is_correct' => true],
                        ['content' => 'Cerita dongeng', 'is_correct' => false],
                        ['content' => 'Lukisan abstrak', 'is_correct' => false],
                        ['content' => 'Musik instrumental', 'is_correct' => false],
                    ],
                ],
            ],
        ];

        return $data[$pillar->slug] ?? [];
    }

    private function getDragDropData(Pillar $pillar): array
    {
        $data = [
            'dekomposisi' => [
                [
                    'content' => 'Urutkan langkah-langkah dekomposisi dalam menyelesaikan proyek pembuatan website:',
                    'options' => [
                        'Identifikasi tujuan website',
                        'Tentukan fitur-fitur yang dibutuhkan',
                        'Pecah setiap fitur menjadi komponen kecil',
                        'Kerjakan setiap komponen secara terpisah',
                        'Gabungkan semua komponen menjadi website utuh',
                    ],
                ],
                [
                    'content' => 'Urutkan langkah dekomposisi membuat presentasi:',
                    'options' => [
                        'Tentukan topik presentasi',
                        'Buat outline materi',
                        'Siapkan konten setiap slide',
                        'Desain visual slide',
                        'Review dan finalisasi',
                    ],
                ],
                [
                    'content' => 'Urutkan proses dekomposisi dalam membuat aplikasi mobile:',
                    'options' => [
                        'Analisis kebutuhan pengguna',
                        'Desain antarmuka (UI/UX)',
                        'Implementasi fitur inti',
                        'Testing dan debugging',
                        'Deployment ke app store',
                    ],
                ],
            ],
            'pengenalan-pola' => [
                [
                    'content' => 'Urutkan deret bilangan berikut sesuai pola yang benar (kelipatan 5):',
                    'options' => [
                        '5',
                        '10',
                        '15',
                        '20',
                        '25',
                    ],
                ],
                [
                    'content' => 'Urutkan hari dalam seminggu sesuai pola:',
                    'options' => [
                        'Senin',
                        'Selasa',
                        'Rabu',
                        'Kamis',
                        'Jumat',
                    ],
                ],
                [
                    'content' => 'Urutkan bulan dalam setahun (Januari - Mei):',
                    'options' => [
                        'Januari',
                        'Februari',
                        'Maret',
                        'April',
                        'Mei',
                    ],
                ],
            ],
            'abstraksi' => [
                [
                    'content' => 'Urutkan tingkat abstraksi dari yang paling detail ke paling abstrak:',
                    'options' => [
                        'Kode program lengkap',
                        'Pseudocode',
                        'Flowchart',
                        'Deskripsi algoritma',
                        'Nama fungsi saja',
                    ],
                ],
                [
                    'content' => 'Urutkan level abstraksi peta dari detail ke umum:',
                    'options' => [
                        'Denah rumah',
                        'Peta kompleks perumahan',
                        'Peta kecamatan',
                        'Peta kota',
                        'Peta provinsi',
                    ],
                ],
                [
                    'content' => 'Urutkan proses abstraksi dalam membuat model data:',
                    'options' => [
                        'Identifikasi semua data yang ada',
                        'Pilih data yang relevan',
                        'Kelompokkan data sejenis',
                        'Buat representasi sederhana',
                        'Definisikan interface',
                    ],
                ],
            ],
            'algoritma' => [
                [
                    'content' => 'Urutkan langkah algoritma menyeberang jalan:',
                    'options' => [
                        'Berdiri di tepi jalan',
                        'Lihat ke kiri',
                        'Lihat ke kanan',
                        'Pastikan tidak ada kendaraan',
                        'Jalan menyeberang dengan cepat',
                    ],
                ],
                [
                    'content' => 'Urutkan algoritma membuat teh manis:',
                    'options' => [
                        'Siapkan gelas dan teh celup',
                        'Masak air hingga mendidih',
                        'Tuang air panas ke gelas',
                        'Celupkan teh dan tunggu 3 menit',
                        'Tambahkan gula dan aduk',
                    ],
                ],
                [
                    'content' => 'Urutkan algoritma login ke aplikasi:',
                    'options' => [
                        'Buka aplikasi',
                        'Masukkan username',
                        'Masukkan password',
                        'Klik tombol login',
                        'Tunggu verifikasi dan masuk ke dashboard',
                    ],
                ],
            ],
        ];

        return $data[$pillar->slug] ?? [];
    }
}
