<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Minat',
                'description' => 'Pertanyaan untuk mengetahui bidang yang diminati siswa.',
            ],
            [
                'name' => 'Bakat',
                'description' => 'Pertanyaan untuk mengetahui kemampuan dan kecenderungan bakat siswa.',
            ],
            [
                'name' => 'Kepribadian & Karier',
                'description' => 'Pertanyaan untuk mengetahui karakter, gaya kerja, dan kecenderungan karier siswa.',
            ],
        ];

        foreach ($categories as $category) {
            DB::table('question_categories')->updateOrInsert(
                ['name' => $category['name']],
                $category
            );
        }
    }
}