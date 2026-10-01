<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorSeeder extends Seeder
{
    public function run(): void
    {
        $categories = DB::table('interest_categories')
            ->pluck('id', 'name');

        $majors = [
            [
                'name' => 'Informatika',
                'category' => 'Teknologi & Komputer',
                'description' => 'Mempelajari ilmu komputer, algoritma, pemrograman, dan teknologi informasi.',
            ],
            [
                'name' => 'Sistem Informasi',
                'category' => 'Teknologi & Komputer',
                'description' => 'Mempelajari teknologi informasi dan penerapannya dalam organisasi dan bisnis.',
            ],
            [
                'name' => 'Teknik Komputer',
                'category' => 'Teknologi & Komputer',
                'description' => 'Mempelajari perangkat keras komputer, jaringan, dan sistem komputer.',
            ],
            [
                'name' => 'Teknik Elektro',
                'category' => 'Teknologi & Komputer',
                'description' => 'Mempelajari sistem kelistrikan, elektronika, dan teknologi elektro.',
            ],

            [
                'name' => 'Manajemen',
                'category' => 'Bisnis & Ekonomi',
                'description' => 'Mempelajari pengelolaan organisasi, bisnis, sumber daya, dan strategi.',
            ],
            [
                'name' => 'Akuntansi',
                'category' => 'Bisnis & Ekonomi',
                'description' => 'Mempelajari pencatatan, pengelolaan, dan analisis keuangan.',
            ],
            [
                'name' => 'Ekonomi',
                'category' => 'Bisnis & Ekonomi',
                'description' => 'Mempelajari aktivitas ekonomi, pasar, kebijakan, dan pembangunan ekonomi.',
            ],
            [
                'name' => 'Bisnis Digital',
                'category' => 'Bisnis & Ekonomi',
                'description' => 'Mempelajari bisnis dengan pemanfaatan teknologi dan platform digital.',
            ],

            [
                'name' => 'Matematika',
                'category' => 'Sains & Matematika',
                'description' => 'Mempelajari konsep matematika, analisis, dan pemodelan.',
            ],
            [
                'name' => 'Fisika',
                'category' => 'Sains & Matematika',
                'description' => 'Mempelajari fenomena alam dan hukum-hukum fisika.',
            ],
            [
                'name' => 'Kimia',
                'category' => 'Sains & Matematika',
                'description' => 'Mempelajari materi, struktur, sifat, dan reaksi kimia.',
            ],
            [
                'name' => 'Biologi',
                'category' => 'Sains & Matematika',
                'description' => 'Mempelajari makhluk hidup dan proses biologis.',
            ],

            [
                'name' => 'Kedokteran',
                'category' => 'Kesehatan',
                'description' => 'Mempelajari ilmu kedokteran dan kesehatan manusia.',
            ],
            [
                'name' => 'Keperawatan',
                'category' => 'Kesehatan',
                'description' => 'Mempelajari pelayanan dan perawatan kesehatan.',
            ],
            [
                'name' => 'Farmasi',
                'category' => 'Kesehatan',
                'description' => 'Mempelajari obat-obatan dan ilmu kefarmasian.',
            ],
            [
                'name' => 'Kesehatan Masyarakat',
                'category' => 'Kesehatan',
                'description' => 'Mempelajari kesehatan masyarakat dan pencegahan penyakit.',
            ],

            [
                'name' => 'Psikologi',
                'category' => 'Sosial & Humaniora',
                'description' => 'Mempelajari perilaku, pikiran, dan proses mental manusia.',
            ],
            [
                'name' => 'Ilmu Hukum',
                'category' => 'Sosial & Humaniora',
                'description' => 'Mempelajari hukum, peraturan, dan sistem hukum.',
            ],
            [
                'name' => 'Ilmu Politik',
                'category' => 'Sosial & Humaniora',
                'description' => 'Mempelajari politik, pemerintahan, dan hubungan kekuasaan.',
            ],
            [
                'name' => 'Sosiologi',
                'category' => 'Sosial & Humaniora',
                'description' => 'Mempelajari masyarakat, hubungan sosial, dan perubahan sosial.',
            ],

            [
                'name' => 'Ilmu Komunikasi',
                'category' => 'Bahasa & Komunikasi',
                'description' => 'Mempelajari komunikasi, media, jurnalistik, dan public relations.',
            ],
            [
                'name' => 'Sastra Inggris',
                'category' => 'Bahasa & Komunikasi',
                'description' => 'Mempelajari bahasa, sastra, dan budaya Inggris.',
            ],
            [
                'name' => 'Sastra Indonesia',
                'category' => 'Bahasa & Komunikasi',
                'description' => 'Mempelajari bahasa dan sastra Indonesia.',
            ],

            [
                'name' => 'Desain Komunikasi Visual',
                'category' => 'Seni & Desain',
                'description' => 'Mempelajari komunikasi visual, desain grafis, dan media kreatif.',
            ],
            [
                'name' => 'Desain Interior',
                'category' => 'Seni & Desain',
                'description' => 'Mempelajari perancangan ruang dan interior.',
            ],
            [
                'name' => 'Seni Rupa',
                'category' => 'Seni & Desain',
                'description' => 'Mempelajari seni visual dan berbagai teknik seni rupa.',
            ],

            [
                'name' => 'Pendidikan Matematika',
                'category' => 'Pendidikan',
                'description' => 'Mempelajari pendidikan dan pengajaran matematika.',
            ],
            [
                'name' => 'Pendidikan Bahasa Indonesia',
                'category' => 'Pendidikan',
                'description' => 'Mempelajari pendidikan dan pengajaran bahasa Indonesia.',
            ],
            [
                'name' => 'Pendidikan Bahasa Inggris',
                'category' => 'Pendidikan',
                'description' => 'Mempelajari pendidikan dan pengajaran bahasa Inggris.',
            ],
        ];

        foreach ($majors as $major) {
            DB::table('majors')->updateOrInsert(
                ['name' => $major['name']],
                [
                    'name' => $major['name'],
                    'description' => $major['description'],
                    'category_id' => $categories[$major['category']] ?? null,
                ]
            );
        }
    }
}