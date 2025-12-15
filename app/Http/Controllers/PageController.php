<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the Tim Pengembang page.
     */
    public function timPengembang()
    {
        $team = [
            [
                'name' => 'Isa Aulia Almadani',
                'role' => 'Developer & Researcher',
                'bio' => 'Mahasiswa Pendidikan Teknik Informatika dan Komputer UNS 2023',
                'image' => asset('images/team/isa-aulia-almadani.png'),
            ],
        ];

        return view('pages.tim-pengembang', compact('team'));
    }

    /**
     * Display the Sumber/References page.
     */
    public function sumber()
    {
        $sources = [
            'text' => [
                [
                    'title' => 'CP & ATP - Informatika Fase E',
                    'author' => 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi',
                    'year' => 'n.d.',
                    'description' => 'Capaian pembelajaran dan alur tujuan pembelajaran Informatika untuk Fase E (SMK Kelas X).',
                    'url' => 'https://guru.kemendikdasmen.go.id/kurikulum/referensi-penerapan/capaian-pembelajaran/sd-sma/informatika/fase-e',
                ],
                [
                    'title' => 'Computational Thinking: A Beginner\'s Guide',
                    'author' => 'John Doe',
                    'year' => '2021',
                    'description' => 'Panduan dasar berpikir komputasional untuk pemula.',
                ],
                [
                    'title' => 'Problem Solving dengan Pendekatan Algoritmik',
                    'author' => 'Jane Smith',
                    'year' => '2020',
                    'description' => 'Membahas cara menyelesaikan masalah dengan pendekatan algoritma.',
                ],
            ],
            'video' => [
                [
                    'title' => 'Introduction to Computational Thinking',
                    'channel' => 'CS Education Channel',
                    'url' => 'https://youtube.com',
                    'description' => 'Video pengenalan konsep berpikir komputasional.',
                ],
                [
                    'title' => 'Decomposition Explained',
                    'channel' => 'Learn Programming',
                    'url' => 'https://youtube.com',
                    'description' => 'Penjelasan mendalam tentang dekomposisi.',
                ],
                [
                    'title' => 'Pattern Recognition in Daily Life',
                    'channel' => 'Tech Learning',
                    'url' => 'https://youtube.com',
                    'description' => 'Bagaimana pengenalan pola diterapkan dalam kehidupan sehari-hari.',
                ],
            ],
        ];

        return view('pages.sumber', compact('sources'));
    }
}
