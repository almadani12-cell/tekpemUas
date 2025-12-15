<?php

namespace Database\Seeders;

use App\Models\Pillar;
use Illuminate\Database\Seeder;

class PillarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pillars = [
            [
                'name' => 'Dekomposisi',
                'slug' => 'dekomposisi',
                'description' => 'Dekomposisi adalah proses memecah masalah kompleks menjadi bagian-bagian yang lebih kecil dan mudah dikelola. Dengan dekomposisi, kita dapat menyelesaikan masalah secara sistematis.',
                'icon' => 'puzzle',
                'color' => 'indigo',
                'order' => 1,
            ],
            [
                'name' => 'Pengenalan Pola',
                'slug' => 'pengenalan-pola',
                'description' => 'Pengenalan pola adalah kemampuan untuk menemukan kesamaan atau pola dalam masalah. Dengan mengenali pola, kita dapat menggunakan solusi yang sudah ada untuk masalah serupa.',
                'icon' => 'pattern',
                'color' => 'teal',
                'order' => 2,
            ],
            [
                'name' => 'Abstraksi',
                'slug' => 'abstraksi',
                'description' => 'Abstraksi adalah proses menyaring informasi yang tidak penting dan fokus pada hal-hal yang relevan. Ini membantu kita menyederhanakan masalah kompleks.',
                'icon' => 'filter',
                'color' => 'amber',
                'order' => 3,
            ],
            [
                'name' => 'Algoritma',
                'slug' => 'algoritma',
                'description' => 'Algoritma adalah serangkaian langkah-langkah terstruktur untuk menyelesaikan masalah. Algoritma membantu kita membuat solusi yang dapat diulang dan diikuti.',
                'icon' => 'steps',
                'color' => 'rose',
                'order' => 4,
            ],
        ];

        foreach ($pillars as $pillar) {
            Pillar::create($pillar);
        }
    }
}
