<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterestCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Teknologi & Komputer',
                'description' => 'Bidang teknologi informasi, komputer, pemrograman, dan sistem digital.',
                'color_code' => '#3B82F6',
            ],
            [
                'name' => 'Bisnis & Ekonomi',
                'description' => 'Bidang bisnis, ekonomi, manajemen, keuangan, dan kewirausahaan.',
                'color_code' => '#10B981',
            ],
            [
                'name' => 'Sains & Matematika',
                'description' => 'Bidang ilmu pengetahuan alam, matematika, dan analisis ilmiah.',
                'color_code' => '#8B5CF6',
            ],
            [
                'name' => 'Kesehatan',
                'description' => 'Bidang kesehatan, kedokteran, keperawatan, dan ilmu kesehatan.',
                'color_code' => '#EF4444',
            ],
            [
                'name' => 'Sosial & Humaniora',
                'description' => 'Bidang sosial, hukum, psikologi, politik, dan ilmu humaniora.',
                'color_code' => '#F59E0B',
            ],
            [
                'name' => 'Bahasa & Komunikasi',
                'description' => 'Bidang bahasa, komunikasi, jurnalistik, dan hubungan masyarakat.',
                'color_code' => '#06B6D4',
            ],
            [
                'name' => 'Seni & Desain',
                'description' => 'Bidang seni, desain, multimedia, dan industri kreatif.',
                'color_code' => '#EC4899',
            ],
            [
                'name' => 'Pendidikan',
                'description' => 'Bidang pendidikan, pengajaran, dan keguruan.',
                'color_code' => '#6366F1',
            ],
        ];

        foreach ($categories as $category) {
            DB::table('interest_categories')->updateOrInsert(
                ['name' => $category['name']],
                $category
            );
        }
    }
}