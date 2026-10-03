<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    { $this->call([
    InterestCategorySeeder::class,
    MajorSeeder::class,
    UniversitySeeder::class,
    UniversityMajorSeeder::class,

    AssessmentTypeSeeder::class,
    AssessmentSubtestSeeder::class,

    QuestionCategorySeeder::class,
    QuestionSeeder::class,
    QuestionOptionSeeder::class,
]);
    }
}
