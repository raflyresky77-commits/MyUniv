<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionOptionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = DB::table('questions')->get();

        $options = [
            [
                'text' => 'Sangat Tidak Setuju',
                'score' => 1,
            ],
            [
                'text' => 'Tidak Setuju',
                'score' => 2,
            ],
            [
                'text' => 'Netral',
                'score' => 3,
            ],
            [
                'text' => 'Setuju',
                'score' => 4,
            ],
            [
                'text' => 'Sangat Setuju',
                'score' => 5,
            ],
        ];

        foreach ($questions as $question) {
            foreach ($options as $option) {
                DB::table('question_options')->updateOrInsert(
                    [
                        'question_id' => $question->id,
                        'option_text' => $option['text'],
                    ],
                    [
                        'score' => $option['score'],
                    ]
                );
            }
        }
    }
}