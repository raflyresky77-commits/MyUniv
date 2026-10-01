<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniversityMajorSeeder extends Seeder
{
    public function run(): void
    {
        $universities = DB::table('universities')
            ->pluck('id', 'name');

        $majors = DB::table('majors')
            ->pluck('id', 'name');

        $relations = [
            ['Institut Teknologi Bandung', 'Informatika'],
            ['Institut Teknologi Bandung', 'Teknik Komputer'],
            ['Institut Teknologi Bandung', 'Teknik Elektro'],
            ['Institut Teknologi Bandung', 'Matematika'],
            ['Institut Teknologi Bandung', 'Fisika'],

            ['Universitas Padjadjaran', 'Informatika'],
            ['Universitas Padjadjaran', 'Manajemen'],
            ['Universitas Padjadjaran', 'Akuntansi'],
            ['Universitas Padjadjaran', 'Psikologi'],
            ['Universitas Padjadjaran', 'Ilmu Komunikasi'],

            ['Universitas Indonesia', 'Informatika'],
            ['Universitas Indonesia', 'Sistem Informasi'],
            ['Universitas Indonesia', 'Manajemen'],
            ['Universitas Indonesia', 'Akuntansi'],
            ['Universitas Indonesia', 'Psikologi'],
            ['Universitas Indonesia', 'Ilmu Hukum'],

            ['Institut Teknologi Sepuluh Nopember', 'Informatika'],
            ['Institut Teknologi Sepuluh Nopember', 'Sistem Informasi'],
            ['Institut Teknologi Sepuluh Nopember', 'Teknik Komputer'],
            ['Institut Teknologi Sepuluh Nopember', 'Teknik Elektro'],

            ['Universitas Gadjah Mada', 'Informatika'],
            ['Universitas Gadjah Mada', 'Manajemen'],
            ['Universitas Gadjah Mada', 'Psikologi'],
            ['Universitas Gadjah Mada', 'Ilmu Hukum'],

            ['Telkom University', 'Informatika'],
            ['Telkom University', 'Sistem Informasi'],
            ['Telkom University', 'Teknik Komputer'],
            ['Telkom University', 'Bisnis Digital'],
            ['Telkom University', 'Desain Komunikasi Visual'],
        ];

        foreach ($relations as [$universityName, $majorName]) {
            if (!isset($universities[$universityName])) {
                continue;
            }

            if (!isset($majors[$majorName])) {
                continue;
            }

            DB::table('university_majors')->updateOrInsert(
                [
                    'university_id' => $universities[$universityName],
                    'major_id' => $majors[$majorName],
                ],
                [
                    'additional_info' => null,
                ]
            );
        }
    }
}