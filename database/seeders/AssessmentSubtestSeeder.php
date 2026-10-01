<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentSubtestSeeder extends Seeder
{
    public function run(): void
    {
        $types = DB::table('assessment_types')
            ->pluck('id', 'code');

        $subtests = [
            [
                'type' => 'personality_career',
                'name' => 'Kepribadian Karier',
                'code' => 'personality',
                'description' => 'Tes untuk mengetahui kecenderungan kepribadian karier.',
                'sort_order' => 1,
            ],

            [
                'type' => 'ability',
                'name' => 'Numerik',
                'code' => 'numeric',
                'description' => 'Tes kemampuan numerik dan perhitungan.',
                'sort_order' => 1,
            ],
            [
                'type' => 'ability',
                'name' => 'Verbal',
                'code' => 'verbal',
                'description' => 'Tes kemampuan bahasa dan pemahaman verbal.',
                'sort_order' => 2,
            ],
            [
                'type' => 'ability',
                'name' => 'Abstrak',
                'code' => 'abstract',
                'description' => 'Tes kemampuan berpikir abstrak dan mengenali pola.',
                'sort_order' => 3,
            ],
            [
                'type' => 'ability',
                'name' => 'Kreativitas',
                'code' => 'creativity',
                'description' => 'Tes kreativitas melalui aktivitas menggambar atau pengembangan ide.',
                'sort_order' => 4,
            ],

            [
                'type' => 'interest_talent',
                'name' => 'Minat Bakat',
                'code' => 'interest_talent',
                'description' => 'Tes untuk mengetahui minat dan preferensi terhadap bidang pekerjaan.',
                'sort_order' => 1,
            ],
        ];

        foreach ($subtests as $subtest) {
            $typeId = $types[$subtest['type']] ?? null;

            if (!$typeId) {
                continue;
            }

            DB::table('assessment_subtests')->updateOrInsert(
                [
                    'assessment_type_id' => $typeId,
                    'code' => $subtest['code'],
                ],
                [
                    'name' => $subtest['name'],
                    'description' => $subtest['description'],
                    'sort_order' => $subtest['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }
}