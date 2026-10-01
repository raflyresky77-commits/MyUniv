<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniversitySeeder extends Seeder
{
    public function run(): void
    {
        $universities = [
            [
                'name' => 'Institut Teknologi Bandung',
                'type' => 'PTN',
                'location' => 'Bandung, Jawa Barat',
                'website' => 'https://itb.ac.id',
                'description' => 'Perguruan tinggi negeri yang berfokus pada sains, teknologi, seni, dan bidang terkait.',
                'thumbnail' => null,
            ],
            [
                'name' => 'Universitas Padjadjaran',
                'type' => 'PTN',
                'location' => 'Sumedang, Jawa Barat',
                'website' => 'https://unpad.ac.id',
                'description' => 'Perguruan tinggi negeri di Jawa Barat dengan berbagai bidang studi.',
                'thumbnail' => null,
            ],
            [
                'name' => 'Universitas Indonesia',
                'type' => 'PTN',
                'location' => 'Depok, Jawa Barat',
                'website' => 'https://ui.ac.id',
                'description' => 'Perguruan tinggi negeri dengan berbagai bidang keilmuan.',
                'thumbnail' => null,
            ],
            [
                'name' => 'Institut Teknologi Sepuluh Nopember',
                'type' => 'PTN',
                'location' => 'Surabaya, Jawa Timur',
                'website' => 'https://its.ac.id',
                'description' => 'Perguruan tinggi negeri yang berfokus pada teknologi dan sains.',
                'thumbnail' => null,
            ],
            [
                'name' => 'Universitas Gadjah Mada',
                'type' => 'PTN',
                'location' => 'Sleman, DI Yogyakarta',
                'website' => 'https://ugm.ac.id',
                'description' => 'Perguruan tinggi negeri dengan berbagai bidang keilmuan.',
                'thumbnail' => null,
            ],
            [
                'name' => 'Telkom University',
                'type' => 'PTS',
                'location' => 'Bandung, Jawa Barat',
                'website' => 'https://telkomuniversity.ac.id',
                'description' => 'Perguruan tinggi swasta yang memiliki fokus kuat pada teknologi dan bisnis.',
                'thumbnail' => null,
            ],
        ];

        foreach ($universities as $university) {
            DB::table('universities')->updateOrInsert(
                ['name' => $university['name']],
                $university
            );
        }
    }
}