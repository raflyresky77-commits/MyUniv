<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'name' => 'Tes Kepribadian Karier',
                'code' => 'personality_career',
                'description' => 'Tes untuk mengetahui kecenderungan kepribadian dan karakter yang berkaitan dengan pilihan karier.',
                'is_active' => true,
            ],
            [
                'name' => 'Tes Kemampuan',
                'code' => 'ability',
                'description' => 'Tes kemampuan yang terdiri dari subtes numerik, verbal, abstrak, dan kreativitas.',
                'is_active' => true,
            ],
            [
                'name' => 'Tes Minat Bakat',
                'code' => 'interest_talent',
                'description' => 'Tes untuk mengetahui minat dan kecenderungan bakat siswa.',
                'is_active' => true,
            ],
        ];

        foreach ($types as $type) {
            DB::table('assessment_types')->updateOrInsert(
                ['code' => $type['code']],
                $type
            );
        }
    }
}