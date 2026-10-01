<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Ambil ID kategori pertanyaan
        |--------------------------------------------------------------------------
        */

        $categories = DB::table('question_categories')
            ->pluck('id', 'name');

        /*
        |--------------------------------------------------------------------------
        | Ambil ID subtest
        |--------------------------------------------------------------------------
        */

        $subtests = DB::table('assessment_subtests')
            ->pluck('id', 'code');

        /*
        |--------------------------------------------------------------------------
        | Pastikan data master tersedia
        |--------------------------------------------------------------------------
        */

        $requiredCategories = [
            'Minat',
            'Bakat',
            'Kepribadian & Karier',
        ];

        foreach ($requiredCategories as $category) {
            if (!isset($categories[$category])) {
                throw new \Exception(
                    "Question category '{$category}' tidak ditemukan."
                );
            }
        }

        $requiredSubtests = [
            'personality',
            'numeric',
            'verbal',
            'abstract',
            'creativity',
            'interest_talent',
        ];

        foreach ($requiredSubtests as $subtest) {
            if (!isset($subtests[$subtest])) {
                throw new \Exception(
                    "Assessment subtest '{$subtest}' tidak ditemukan."
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | DATA SOAL
        |--------------------------------------------------------------------------
        */

        $questions = [

            /*
            |--------------------------------------------------------------------------
            | 1. TES KEPRIBADIAN KARIER
            |--------------------------------------------------------------------------
            */

            [
                'subtest' => 'personality',
                'category' => 'Kepribadian & Karier',
                'type' => 'likert',
                'question_text' =>
                    'Saya merasa nyaman bekerja dengan tenang dan menyelesaikan tugas secara bertahap.',
            ],

            [
                'subtest' => 'personality',
                'category' => 'Kepribadian & Karier',
                'type' => 'likert',
                'question_text' =>
                    'Saya mudah berkomunikasi dan menyampaikan ide kepada orang lain.',
            ],

            [
                'subtest' => 'personality',
                'category' => 'Kepribadian & Karier',
                'type' => 'likert',
                'question_text' =>
                    'Saya senang mencoba hal baru meskipun terdapat tantangan.',
            ],

            [
                'subtest' => 'personality',
                'category' => 'Kepribadian & Karier',
                'type' => 'likert',
                'question_text' =>
                    'Saya menghargai pendapat orang lain meskipun berbeda dengan pendapat saya.',
            ],

            [
                'subtest' => 'personality',
                'category' => 'Kepribadian & Karier',
                'type' => 'likert',
                'question_text' =>
                    'Saya mampu tetap tenang ketika menghadapi masalah.',
            ],

            [
                'subtest' => 'personality',
                'category' => 'Kepribadian & Karier',
                'type' => 'likert',
                'question_text' =>
                    'Saya lebih suka bekerja dengan mengikuti rencana yang sudah dibuat.',
            ],

            [
                'subtest' => 'personality',
                'category' => 'Kepribadian & Karier',
                'type' => 'likert',
                'question_text' =>
                    'Saya senang membantu orang lain menyelesaikan masalah.',
            ],

            [
                'subtest' => 'personality',
                'category' => 'Kepribadian & Karier',
                'type' => 'likert',
                'question_text' =>
                    'Saya tertarik mengambil tanggung jawab ketika bekerja dalam kelompok.',
            ],

            [
                'subtest' => 'personality',
                'category' => 'Kepribadian & Karier',
                'type' => 'likert',
                'question_text' =>
                    'Saya senang mencari cara baru ketika cara sebelumnya tidak berhasil.',
            ],

            [
                'subtest' => 'personality',
                'category' => 'Kepribadian & Karier',
                'type' => 'likert',
                'question_text' =>
                    'Saya dapat bekerja dengan baik meskipun harus menghadapi perubahan.',
            ],


            /*
            |--------------------------------------------------------------------------
            | 2. TES KEMAMPUAN - NUMERIK
            |--------------------------------------------------------------------------
            */

            [
                'subtest' => 'numeric',
                'category' => 'Bakat',
                'type' => 'multiple_choice',
                'question_text' =>
                    'Seorang pedagang membeli 4 kg apel dengan harga Rp15.000 per kg. Ia menjual seluruhnya dengan harga Rp70.000. Berapa keuntungan pedagang tersebut?',
                'options' => [
                    ['text' => 'Rp5.000', 'score' => 0],
                    ['text' => 'Rp10.000', 'score' => 1],
                    ['text' => 'Rp15.000', 'score' => 0],
                    ['text' => 'Rp20.000', 'score' => 0],
                ],
            ],

            [
                'subtest' => 'numeric',
                'category' => 'Bakat',
                'type' => 'multiple_choice',
                'question_text' =>
                    'Jika 5 buku berharga Rp50.000, berapa harga 8 buku dengan harga per buku yang sama?',
                'options' => [
                    ['text' => 'Rp60.000', 'score' => 0],
                    ['text' => 'Rp70.000', 'score' => 0],
                    ['text' => 'Rp80.000', 'score' => 1],
                    ['text' => 'Rp90.000', 'score' => 0],
                ],
            ],

            [
                'subtest' => 'numeric',
                'category' => 'Bakat',
                'type' => 'multiple_choice',
                'question_text' =>
                    'Sebuah kelas memiliki 40 siswa. Jika 25% siswa mengikuti ekstrakurikuler basket, berapa siswa yang mengikuti basket?',
                'options' => [
                    ['text' => '5 siswa', 'score' => 0],
                    ['text' => '10 siswa', 'score' => 1],
                    ['text' => '15 siswa', 'score' => 0],
                    ['text' => '20 siswa', 'score' => 0],
                ],
            ],

            [
                'subtest' => 'numeric',
                'category' => 'Bakat',
                'type' => 'multiple_choice',
                'question_text' =>
                    'Sebuah kendaraan menempuh jarak 180 km dalam waktu 3 jam. Berapa rata-rata kecepatannya?',
                'options' => [
                    ['text' => '40 km/jam', 'score' => 0],
                    ['text' => '50 km/jam', 'score' => 0],
                    ['text' => '60 km/jam', 'score' => 1],
                    ['text' => '70 km/jam', 'score' => 0],
                ],
            ],

            [
                'subtest' => 'numeric',
                'category' => 'Bakat',
                'type' => 'multiple_choice',
                'question_text' =>
                    'Deret angka berikut adalah 2, 4, 8, 16, ... Angka berikutnya adalah?',
                'options' => [
                    ['text' => '20', 'score' => 0],
                    ['text' => '24', 'score' => 0],
                    ['text' => '30', 'score' => 0],
                    ['text' => '32', 'score' => 1],
                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | 3. TES KEMAMPUAN - VERBAL
            |--------------------------------------------------------------------------
            */

            [
                'subtest' => 'verbal',
                'category' => 'Bakat',
                'type' => 'multiple_choice',
                'question_text' =>
                    'Pilih sinonim dari kata "cepat".',
                'options' => [
                    ['text' => 'Lambat', 'score' => 0],
                    ['text' => 'Kilat', 'score' => 1],
                    ['text' => 'Berat', 'score' => 0],
                    ['text' => 'Jauh', 'score' => 0],
                ],
            ],

            [
                'subtest' => 'verbal',
                'category' => 'Bakat',
                'type' => 'multiple_choice',
                'question_text' =>
                    'Pilih antonim dari kata "optimis".',
                'options' => [
                    ['text' => 'Semangat', 'score' => 0],
                    ['text' => 'Percaya diri', 'score' => 0],
                    ['text' => 'Pesimis', 'score' => 1],
                    ['text' => 'Berani', 'score' => 0],
                ],
            ],

            [
                'subtest' => 'verbal',
                'category' => 'Bakat',
                'type' => 'multiple_choice',
                'question_text' =>
                    'Kata "dokter" memiliki hubungan dengan "rumah sakit", sebagaimana "guru" memiliki hubungan dengan...',
                'options' => [
                    ['text' => 'Pasar', 'score' => 0],
                    ['text' => 'Sekolah', 'score' => 1],
                    ['text' => 'Kantor', 'score' => 0],
                    ['text' => 'Terminal', 'score' => 0],
                ],
            ],

            [
                'subtest' => 'verbal',
                'category' => 'Bakat',
                'type' => 'multiple_choice',
                'question_text' =>
                    'Manakah kata yang tidak termasuk dalam kelompok berikut?',
                'options' => [
                    ['text' => 'Apel', 'score' => 0],
                    ['text' => 'Mangga', 'score' => 0],
                    ['text' => 'Jeruk', 'score' => 0],
                    ['text' => 'Wortel', 'score' => 1],
                ],
            ],

            [
                'subtest' => 'verbal',
                'category' => 'Bakat',
                'type' => 'multiple_choice',
                'question_text' =>
                    'Pilih kata yang paling tepat untuk melengkapi kalimat: "Ia belajar dengan tekun sehingga memperoleh ... yang baik."',
                'options' => [
                    ['text' => 'hasil', 'score' => 1],
                    ['text' => 'jalan', 'score' => 0],
                    ['text' => 'warna', 'score' => 0],
                    ['text' => 'suara', 'score' => 0],
                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | 4. TES KEMAMPUAN - ABSTRAK
            |--------------------------------------------------------------------------
            */

            [
                'subtest' => 'abstract',
                'category' => 'Bakat',
                'type' => 'image_choice',
                'question_text' =>
                    'Tentukan pilihan gambar berikutnya berdasarkan pola yang diberikan.',
                'options' => [
                    ['text' => 'A', 'score' => 1],
                    ['text' => 'B', 'score' => 0],
                    ['text' => 'C', 'score' => 0],
                    ['text' => 'D', 'score' => 0],
                ],
            ],

            [
                'subtest' => 'abstract',
                'category' => 'Bakat',
                'type' => 'image_choice',
                'question_text' =>
                    'Perhatikan perubahan posisi bentuk pada gambar. Pilih gambar yang melanjutkan pola.',
                'options' => [
                    ['text' => 'A', 'score' => 0],
                    ['text' => 'B', 'score' => 1],
                    ['text' => 'C', 'score' => 0],
                    ['text' => 'D', 'score' => 0],
                ],
            ],

            [
                'subtest' => 'abstract',
                'category' => 'Bakat',
                'type' => 'image_choice',
                'question_text' =>
                    'Pilih gambar yang memiliki pola lanjutan paling tepat.',
                'options' => [
                    ['text' => 'A', 'score' => 0],
                    ['text' => 'B', 'score' => 0],
                    ['text' => 'C', 'score' => 1],
                    ['text' => 'D', 'score' => 0],
                ],
            ],

            [
                'subtest' => 'abstract',
                'category' => 'Bakat',
                'type' => 'image_choice',
                'question_text' =>
                    'Tentukan bentuk berikutnya berdasarkan urutan gambar.',
                'options' => [
                    ['text' => 'A', 'score' => 0],
                    ['text' => 'B', 'score' => 0],
                    ['text' => 'C', 'score' => 0],
                    ['text' => 'D', 'score' => 1],
                ],
            ],

            [
                'subtest' => 'abstract',
                'category' => 'Bakat',
                'type' => 'image_choice',
                'question_text' =>
                    'Pilih susunan bentuk yang paling tepat untuk melanjutkan pola.',
                'options' => [
                    ['text' => 'A', 'score' => 1],
                    ['text' => 'B', 'score' => 0],
                    ['text' => 'C', 'score' => 0],
                    ['text' => 'D', 'score' => 0],
                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | 5. TES KEMAMPUAN - KREATIVITAS
            |--------------------------------------------------------------------------
            */

            [
                'subtest' => 'creativity',
                'category' => 'Bakat',
                'type' => 'drawing',
                'question_text' =>
                    'Kembangkan gambar dari bentuk lingkaran berikut menjadi sebuah gambar yang memiliki makna.',
            ],

            [
                'subtest' => 'creativity',
                'category' => 'Bakat',
                'type' => 'drawing',
                'question_text' =>
                    'Kembangkan gambar dari bentuk garis lengkung berikut menjadi sebuah objek atau ilustrasi.',
            ],

            [
                'subtest' => 'creativity',
                'category' => 'Bakat',
                'type' => 'drawing',
                'question_text' =>
                    'Buatlah gambar kreatif dengan melanjutkan bentuk dasar yang diberikan.',
            ],

            [
                'subtest' => 'creativity',
                'category' => 'Bakat',
                'type' => 'drawing',
                'question_text' =>
                    'Gunakan bentuk dasar yang tersedia untuk membuat sebuah ilustrasi yang unik.',
            ],

            [
                'subtest' => 'creativity',
                'category' => 'Bakat',
                'type' => 'drawing',
                'question_text' =>
                    'Kembangkan bentuk yang diberikan menjadi gambar sesuai imajinasi Anda.',
            ],


            /*
            |--------------------------------------------------------------------------
            | 6. TES MINAT BAKAT
            |--------------------------------------------------------------------------
            */

            [
                'subtest' => 'interest_talent',
                'category' => 'Minat',
                'type' => 'preference',
                'question_text' =>
                    'Membuat aplikasi atau website.',
            ],

            [
                'subtest' => 'interest_talent',
                'category' => 'Minat',
                'type' => 'preference',
                'question_text' =>
                    'Menganalisis data dan angka.',
            ],

            [
                'subtest' => 'interest_talent',
                'category' => 'Minat',
                'type' => 'preference',
                'question_text' =>
                    'Membuat desain grafis atau ilustrasi.',
            ],

            [
                'subtest' => 'interest_talent',
                'category' => 'Minat',
                'type' => 'preference',
                'question_text' =>
                    'Berbicara dan berkomunikasi dengan banyak orang.',
            ],

            [
                'subtest' => 'interest_talent',
                'category' => 'Minat',
                'type' => 'preference',
                'question_text' =>
                    'Membangun dan mengelola sebuah bisnis.',
            ],

            [
                'subtest' => 'interest_talent',
                'category' => 'Minat',
                'type' => 'preference',
                'question_text' =>
                    'Membantu orang lain menyelesaikan masalah.',
            ],

            [
                'subtest' => 'interest_talent',
                'category' => 'Minat',
                'type' => 'preference',
                'question_text' =>
                    'Melakukan penelitian dan eksperimen.',
            ],

            [
                'subtest' => 'interest_talent',
                'category' => 'Minat',
                'type' => 'preference',
                'question_text' =>
                    'Mengajar atau menjelaskan sesuatu kepada orang lain.',
            ],

            [
                'subtest' => 'interest_talent',
                'category' => 'Minat',
                'type' => 'preference',
                'question_text' =>
                    'Membuat karya seni atau karya kreatif.',
            ],

            [
                'subtest' => 'interest_talent',
                'category' => 'Minat',
                'type' => 'preference',
                'question_text' =>
                    'Merencanakan kegiatan dan mengatur pekerjaan sebuah tim.',
            ],
        ];


        /*
        |--------------------------------------------------------------------------
        | OPTION TEMPLATE
        |--------------------------------------------------------------------------
        */

        $likertOptions = [
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

        $preferenceOptions = [
            [
                'text' => 'Sangat Tidak Suka',
                'score' => 1,
            ],
            [
                'text' => 'Tidak Suka',
                'score' => 2,
            ],
            [
                'text' => 'Netral',
                'score' => 3,
            ],
            [
                'text' => 'Suka',
                'score' => 4,
            ],
            [
                'text' => 'Sangat Suka',
                'score' => 5,
            ],
        ];


        /*
        |--------------------------------------------------------------------------
        | INSERT QUESTIONS
        |--------------------------------------------------------------------------
        */

        foreach ($questions as $question) {

            $subtestId = $subtests[$question['subtest']];
            $categoryId = $categories[$question['category']];

            /*
            |--------------------------------------------------------------------------
            | Simpan question
            |--------------------------------------------------------------------------
            */

            $questionId = DB::table('questions')
                ->where('subtest_id', $subtestId)
                ->where('question_text', $question['question_text'])
                ->value('id');

            if (!$questionId) {

                $questionId = DB::table('questions')->insertGetId([
                    'category_id' => $categoryId,
                    'subtest_id' => $subtestId,
                    'question_text' => $question['question_text'],
                    'type' => $question['type'],
                    'is_active' => true,
                ]);

            } else {

                DB::table('questions')
                    ->where('id', $questionId)
                    ->update([
                        'category_id' => $categoryId,
                        'type' => $question['type'],
                        'is_active' => true,
                    ]);
            }


            /*
            |--------------------------------------------------------------------------
            | DELETE OLD OPTIONS
            |--------------------------------------------------------------------------
            */

            DB::table('question_options')
                ->where('question_id', $questionId)
                ->delete();


            /*
            |--------------------------------------------------------------------------
            | LIKERT
            |--------------------------------------------------------------------------
            */

            if ($question['type'] === 'likert') {

                foreach ($likertOptions as $option) {

                    DB::table('question_options')->insert([
                        'question_id' => $questionId,
                        'option_text' => $option['text'],
                        'score' => $option['score'],
                    ]);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | PREFERENCE
            |--------------------------------------------------------------------------
            */

            elseif ($question['type'] === 'preference') {

                foreach ($preferenceOptions as $option) {

                    DB::table('question_options')->insert([
                        'question_id' => $questionId,
                        'option_text' => $option['text'],
                        'score' => $option['score'],
                    ]);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | MULTIPLE CHOICE / IMAGE CHOICE
            |--------------------------------------------------------------------------
            */

            elseif (
                $question['type'] === 'multiple_choice' ||
                $question['type'] === 'image_choice'
            ) {

                foreach ($question['options'] as $option) {

                    DB::table('question_options')->insert([
                        'question_id' => $questionId,
                        'option_text' => $option['text'],
                        'score' => $option['score'],
                    ]);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | DRAWING
            |--------------------------------------------------------------------------
            */

            elseif ($question['type'] === 'drawing') {

                // Drawing tidak membutuhkan question_options.
                // Jawaban akan disimpan dari canvas oleh frontend.
            }
        }


        /*
        |--------------------------------------------------------------------------
        | OUTPUT
        |--------------------------------------------------------------------------
        */

        $total = DB::table('questions')->count();

        $this->command->info(
            "QuestionSeeder berhasil. Total questions: {$total}"
        );
    }
}