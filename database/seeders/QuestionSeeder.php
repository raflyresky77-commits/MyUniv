<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $categories = DB::table('question_categories')->pluck('id', 'name');
        $subtests = DB::table('assessment_subtests')->pluck('id', 'code');

        $questions = [
            // --- 1. TES KEPRIBADIAN KARIER (12 Soal) ---
            ['subtest' => 'personality', 'category' => 'Kepribadian & Karier', 'type' => 'likert', 'question_text' => 'Saya merasa nyaman bekerja dengan tenang dan menyelesaikan tugas secara bertahap.'],
            ['subtest' => 'personality', 'category' => 'Kepribadian & Karier', 'type' => 'likert', 'question_text' => 'Saya mudah berkomunikasi dan menyampaikan ide kepada orang lain.'],
            ['subtest' => 'personality', 'category' => 'Kepribadian & Karier', 'type' => 'likert', 'question_text' => 'Saya senang mencoba hal baru meskipun terdapat tantangan.'],
            ['subtest' => 'personality', 'category' => 'Kepribadian & Karier', 'type' => 'likert', 'question_text' => 'Saya menghargai pendapat orang lain meskipun berbeda dengan pendapat saya.'],
            ['subtest' => 'personality', 'category' => 'Kepribadian & Karier', 'type' => 'likert', 'question_text' => 'Saya mampu tetap tenang ketika menghadapi masalah.'],
            ['subtest' => 'personality', 'category' => 'Kepribadian & Karier', 'type' => 'likert', 'question_text' => 'Saya lebih suka bekerja dengan mengikuti rencana yang sudah dibuat.'],
            ['subtest' => 'personality', 'category' => 'Kepribadian & Karier', 'type' => 'likert', 'question_text' => 'Saya senang membantu orang lain menyelesaikan masalah.'],
            ['subtest' => 'personality', 'category' => 'Kepribadian & Karier', 'type' => 'likert', 'question_text' => 'Saya tertarik mengambil tanggung jawab ketika bekerja dalam kelompok.'],
            ['subtest' => 'personality', 'category' => 'Kepribadian & Karier', 'type' => 'likert', 'question_text' => 'Saya senang mencari cara baru ketika cara sebelumnya tidak berhasil.'],
            ['subtest' => 'personality', 'category' => 'Kepribadian & Karier', 'type' => 'likert', 'question_text' => 'Saya dapat bekerja dengan baik meskipun harus menghadapi perubahan.'],
            ['subtest' => 'personality', 'category' => 'Kepribadian & Karier', 'type' => 'likert', 'question_text' => 'Saya lebih suka bekerja secara mandiri daripada dalam tim besar.'],
            ['subtest' => 'personality', 'category' => 'Kepribadian & Karier', 'type' => 'likert', 'question_text' => 'Saya selalu memastikan detail pekerjaan terselesaikan dengan sempurna.'],

            // --- 2. TES NUMERIK (10 Soal) ---
            ['subtest' => 'numeric', 'category' => 'Bakat', 'type' => 'multiple_choice', 'question_text' => 'Seorang pedagang membeli 4 kg apel dengan harga Rp15.000 per kg. Ia menjual seluruhnya dengan harga Rp70.000. Berapa keuntungan pedagang tersebut?', 'options' => [['text' => 'Rp5.000', 'score' => 0], ['text' => 'Rp10.000', 'score' => 1], ['text' => 'Rp15.000', 'score' => 0], ['text' => 'Rp20.000', 'score' => 0]]],
            ['subtest' => 'numeric', 'category' => 'Bakat', 'type' => 'multiple_choice', 'question_text' => 'Jika 5 buku berharga Rp50.000, berapa harga 8 buku dengan harga per buku yang sama?', 'options' => [['text' => 'Rp60.000', 'score' => 0], ['text' => 'Rp70.000', 'score' => 0], ['text' => 'Rp80.000', 'score' => 1], ['text' => 'Rp90.000', 'score' => 0]]],
            ['subtest' => 'numeric', 'category' => 'Bakat', 'type' => 'multiple_choice', 'question_text' => 'Sebuah kelas memiliki 40 siswa. Jika 25% siswa mengikuti ekstrakurikuler basket, berapa siswa yang mengikuti basket?', 'options' => [['text' => '5 siswa', 'score' => 0], ['text' => '10 siswa', 'score' => 1], ['text' => '15 siswa', 'score' => 0], ['text' => '20 siswa', 'score' => 0]]],
            ['subtest' => 'numeric', 'category' => 'Bakat', 'type' => 'multiple_choice', 'question_text' => 'Sebuah kendaraan menempuh jarak 180 km dalam waktu 3 jam. Berapa rata-rata kecepatannya?', 'options' => [['text' => '40 km/jam', 'score' => 0], ['text' => '50 km/jam', 'score' => 0], ['text' => '60 km/jam', 'score' => 1], ['text' => '70 km/jam', 'score' => 0]]],
            ['subtest' => 'numeric', 'category' => 'Bakat', 'type' => 'multiple_choice', 'question_text' => 'Deret angka berikut adalah 2, 4, 8, 16, ... Angka berikutnya adalah?', 'options' => [['text' => '20', 'score' => 0], ['text' => '24', 'score' => 0], ['text' => '30', 'score' => 0], ['text' => '32', 'score' => 1]]],
            ['subtest' => 'numeric', 'category' => 'Bakat', 'type' => 'multiple_choice', 'question_text' => 'Berapa nilai 15% dari 200?', 'options' => [['text' => '20', 'score' => 0], ['text' => '25', 'score' => 0], ['text' => '30', 'score' => 1], ['text' => '35', 'score' => 0]]],
            ['subtest' => 'numeric', 'category' => 'Bakat', 'type' => 'multiple_choice', 'question_text' => 'Jika harga sebuah baju didiskon 20% dari harga Rp100.000, berapa harga bayarnya?', 'options' => [['text' => 'Rp70.000', 'score' => 0], ['text' => 'Rp80.000', 'score' => 1], ['text' => 'Rp85.000', 'score' => 0], ['text' => 'Rp90.000', 'score' => 0]]],
            ['subtest' => 'numeric', 'category' => 'Bakat', 'type' => 'multiple_choice', 'question_text' => 'Hasil dari 12 x 12 - 44 adalah...', 'options' => [['text' => '100', 'score' => 1], ['text' => '104', 'score' => 0], ['text' => '96', 'score' => 0], ['text' => '110', 'score' => 0]]],
            ['subtest' => 'numeric', 'category' => 'Bakat', 'type' => 'multiple_choice', 'question_text' => 'Sebuah tangki air berisi 500 liter. Digunakan 150 liter. Sisa air di tangki adalah...', 'options' => [['text' => '300 liter', 'score' => 0], ['text' => '350 liter', 'score' => 1], ['text' => '400 liter', 'score' => 0], ['text' => '450 liter', 'score' => 0]]],
            ['subtest' => 'numeric', 'category' => 'Bakat', 'type' => 'multiple_choice', 'question_text' => 'Angka romawi dari 45 adalah...', 'options' => [['text' => 'XLV', 'score' => 1], ['text' => 'VL', 'score' => 0], ['text' => 'XIV', 'score' => 0], ['text' => 'LXV', 'score' => 0]]],

            // --- 3. TES VERBAL (10 Soal) ---
            ['subtest' => 'verbal', 'category' => 'Bakat', 'type' => 'multiple_choice', 'question_text' => 'Pilih sinonim dari kata "cepat".', 'options' => [['text' => 'Lambat', 'score' => 0], ['text' => 'Kilat', 'score' => 1], ['text' => 'Berat', 'score' => 0], ['text' => 'Jauh', 'score' => 0]]],
            ['subtest' => 'verbal', 'category' => 'Bakat', 'type' => 'multiple_choice', 'question_text' => 'Pilih antonim dari kata "optimis".', 'options' => [['text' => 'Semangat', 'score' => 0], ['text' => 'Percaya diri', 'score' => 0], ['text' => 'Pesimis', 'score' => 1], ['text' => 'Berani', 'score' => 0]]],
            ['subtest' => 'verbal', 'category' => 'Bakat', 'type' => 'multiple_choice', 'question_text' => 'Kata "dokter" berhubungan dengan "rumah sakit", sebagaimana "guru" berhubungan dengan...', 'options' => [['text' => 'Pasar', 'score' => 0], ['text' => 'Sekolah', 'score' => 1], ['text' => 'Kantor', 'score' => 0], ['text' => 'Terminal', 'score' => 0]]],
            ['subtest' => 'verbal', 'category' => 'Bakat', 'type' => 'multiple_choice', 'question_text' => 'Manakah kata yang tidak termasuk dalam kelompok berikut?', 'options' => [['text' => 'Apel', 'score' => 0], ['text' => 'Mangga', 'score' => 0], ['text' => 'Jeruk', 'score' => 0], ['text' => 'Wortel', 'score' => 1]]],
            ['subtest' => 'verbal', 'category' => 'Bakat', 'type' => 'multiple_choice', 'question_text' => 'Pilih kata yang tepat untuk melengkapi kalimat: "Ia belajar tekun sehingga memperoleh ... yang baik."', 'options' => [['text' => 'hasil', 'score' => 1], ['text' => 'jalan', 'score' => 0], ['text' => 'warna', 'score' => 0], ['text' => 'suara', 'score' => 0]]],
            ['subtest' => 'verbal', 'category' => 'Bakat', 'type' => 'multiple_choice', 'question_text' => 'Sinonim dari kata "teliti" adalah...', 'options' => [['text' => 'Cermat', 'score' => 1], ['text' => 'Ceroboh', 'score' => 0], ['text' => 'Lambat', 'score' => 0], ['text' => 'Ragu', 'score' => 0]]],
            ['subtest' => 'verbal', 'category' => 'Bakat', 'type' => 'multiple_choice', 'question_text' => 'Antonim dari kata "mahal" adalah...', 'options' => [['text' => 'Murah', 'score' => 1], ['text' => 'Diskon', 'score' => 0], ['text' => 'Bagus', 'score' => 0], ['text' => 'Banyak', 'score' => 0]]],
            ['subtest' => 'verbal', 'category' => 'Bakat', 'type' => 'multiple_choice', 'question_text' => 'Hubungan "Buku" dan "Membaca" setara dengan "Lagu" dan...', 'options' => [['text' => 'Menulis', 'score' => 0], ['text' => 'Mendengar', 'score' => 1], ['text' => 'Melihat', 'score' => 0], ['text' => 'Berbicara', 'score' => 0]]],
            ['subtest' => 'verbal', 'category' => 'Bakat', 'type' => 'multiple_choice', 'question_text' => 'Manakah yang merupakan penulisan kata baku?', 'options' => [['text' => 'Apotik', 'score' => 0], ['text' => 'Apotek', 'score' => 1], ['text' => 'Jadual', 'score' => 0], ['text' => 'Nasehat', 'score' => 0]]],
            ['subtest' => 'verbal', 'category' => 'Bakat', 'type' => 'multiple_choice', 'question_text' => 'Arti dari kata "inovasi" adalah...', 'options' => [['text' => 'Pembaruan', 'score' => 1], ['text' => 'Penyalinan', 'score' => 0], ['text' => 'Peniruan', 'score' => 0], ['text' => 'Pengulangan', 'score' => 0]]],

            // --- 4. TES ABSTRAK (8 Soal) ---
            ['subtest' => 'abstract', 'category' => 'Bakat', 'type' => 'image_choice', 'question_text' => 'Tentukan pilihan gambar berikutnya berdasarkan pola yang diberikan.', 'options' => [['text' => 'A', 'score' => 1], ['text' => 'B', 'score' => 0], ['text' => 'C', 'score' => 0], ['text' => 'D', 'score' => 0]]],
            ['subtest' => 'abstract', 'category' => 'Bakat', 'type' => 'image_choice', 'question_text' => 'Perhatikan perubahan posisi bentuk pada gambar. Pilih gambar yang melanjutkan pola.', 'options' => [['text' => 'A', 'score' => 0], ['text' => 'B', 'score' => 1], ['text' => 'C', 'score' => 0], ['text' => 'D', 'score' => 0]]],
            ['subtest' => 'abstract', 'category' => 'Bakat', 'type' => 'image_choice', 'question_text' => 'Pilih gambar yang memiliki pola lanjutan paling tepat.', 'options' => [['text' => 'A', 'score' => 0], ['text' => 'B', 'score' => 0], ['text' => 'C', 'score' => 1], ['text' => 'D', 'score' => 0]]],
            ['subtest' => 'abstract', 'category' => 'Bakat', 'type' => 'image_choice', 'question_text' => 'Tentukan bentuk berikutnya berdasarkan urutan gambar.', 'options' => [['text' => 'A', 'score' => 0], ['text' => 'B', 'score' => 0], ['text' => 'C', 'score' => 0], ['text' => 'D', 'score' => 1]]],
            ['subtest' => 'abstract', 'category' => 'Bakat', 'type' => 'image_choice', 'question_text' => 'Pilih susunan bentuk yang paling tepat untuk melanjutkan pola.', 'options' => [['text' => 'A', 'score' => 1], ['text' => 'B', 'score' => 0], ['text' => 'C', 'score' => 0], ['text' => 'D', 'score' => 0]]],
            ['subtest' => 'abstract', 'category' => 'Bakat', 'type' => 'image_choice', 'question_text' => 'Manakah rotasi kubus yang sesuai dengan pola master di atas?', 'options' => [['text' => 'A', 'score' => 1], ['text' => 'B', 'score' => 0], ['text' => 'C', 'score' => 0], ['text' => 'D', 'score' => 0]]],
            ['subtest' => 'abstract', 'category' => 'Bakat', 'type' => 'image_choice', 'question_text' => 'Pilih potongan jaring-jaring bangun ruang yang tepat.', 'options' => [['text' => 'A', 'score' => 0], ['text' => 'B', 'score' => 1], ['text' => 'C', 'score' => 0], ['text' => 'D', 'score' => 0]]],
            ['subtest' => 'abstract', 'category' => 'Bakat', 'type' => 'image_choice', 'question_text' => 'Analisis matriks gambar kosong dan pilih elemen pengisi yang pas.', 'options' => [['text' => 'A', 'score' => 0], ['text' => 'B', 'score' => 0], ['text' => 'C', 'score' => 1], ['text' => 'D', 'score' => 0]]],

            // --- 5. TES KREATIVITAS (5 Soal) ---
            ['subtest' => 'creativity', 'category' => 'Bakat', 'type' => 'drawing', 'question_text' => 'Kembangkan gambar dari bentuk lingkaran berikut menjadi sebuah gambar bermakna.'],
            ['subtest' => 'creativity', 'category' => 'Bakat', 'type' => 'drawing', 'question_text' => 'Kembangkan gambar dari bentuk garis lengkung berikut menjadi sebuah objek/ilustrasi.'],
            ['subtest' => 'creativity', 'category' => 'Bakat', 'type' => 'drawing', 'question_text' => 'Buatlah gambar kreatif dengan melanjutkan bentuk dasar yang diberikan.'],
            ['subtest' => 'creativity', 'category' => 'Bakat', 'type' => 'drawing', 'question_text' => 'Gunakan bentuk dasar yang tersedia untuk membuat sebuah ilustrasi unik.'],
            ['subtest' => 'creativity', 'category' => 'Bakat', 'type' => 'drawing', 'question_text' => 'Kembangkan bentuk yang diberikan menjadi gambar sesuai imajinasi Anda.'],

            // --- 6. TES MINAT BAKAT (10 Soal) ---
            ['subtest' => 'interest_talent', 'category' => 'Minat', 'type' => 'preference', 'question_text' => 'Membuat aplikasi atau website.'],
            ['subtest' => 'interest_talent', 'category' => 'Minat', 'type' => 'preference', 'question_text' => 'Menganalisis data dan angka.'],
            ['subtest' => 'interest_talent', 'category' => 'Minat', 'type' => 'preference', 'question_text' => 'Membuat desain grafis atau ilustrasi.'],
            ['subtest' => 'interest_talent', 'category' => 'Minat', 'type' => 'preference', 'question_text' => 'Berbicara dan berkomunikasi dengan banyak orang.'],
            ['subtest' => 'interest_talent', 'category' => 'Minat', 'type' => 'preference', 'question_text' => 'Membangun dan mengelola sebuah bisnis.'],
            ['subtest' => 'interest_talent', 'category' => 'Minat', 'type' => 'preference', 'question_text' => 'Membantu orang lain menyelesaikan masalah.'],
            ['subtest' => 'interest_talent', 'category' => 'Minat', 'type' => 'preference', 'question_text' => 'Melakukan penelitian dan eksperimen.'],
            ['subtest' => 'interest_talent', 'category' => 'Minat', 'type' => 'preference', 'question_text' => 'Mengajar atau menjelaskan sesuatu kepada orang lain.'],
            ['subtest' => 'interest_talent', 'category' => 'Minat', 'type' => 'preference', 'question_text' => 'Membuat karya seni atau karya kreatif.'],
            ['subtest' => 'interest_talent', 'category' => 'Minat', 'type' => 'preference', 'question_text' => 'Merencanakan kegiatan dan mengatur pekerjaan sebuah tim.'],
        ];

        $likertOptions = [
            ['text' => 'Sangat Tidak Setuju', 'score' => 1],
            ['text' => 'Tidak Setuju', 'score' => 2],
            ['text' => 'Netral', 'score' => 3],
            ['text' => 'Setuju', 'score' => 4],
            ['text' => 'Sangat Setuju', 'score' => 5],
        ];

        $preferenceOptions = [
            ['text' => 'Sangat Tidak Suka', 'score' => 1],
            ['text' => 'Tidak Suka', 'score' => 2],
            ['text' => 'Netral', 'score' => 3],
            ['text' => 'Suka', 'score' => 4],
            ['text' => 'Sangat Suka', 'score' => 5],
        ];

        foreach ($questions as $question) {
            $subtestId = $subtests[$question['subtest']] ?? null;
            $categoryId = $categories[$question['category']] ?? null;

            if (!$subtestId || !$categoryId) continue;

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
                DB::table('questions')->where('id', $questionId)->update([
                    'category_id' => $categoryId,
                    'type' => $question['type'],
                    'is_active' => true,
                ]);
            }

            DB::table('question_options')->where('question_id', $questionId)->delete();

            if ($question['type'] === 'likert') {
                foreach ($likertOptions as $option) {
                    DB::table('question_options')->insert([
                        'question_id' => $questionId,
                        'option_text' => $option['text'],
                        'score' => $option['score'],
                    ]);
                }
            } elseif ($question['type'] === 'preference') {
                foreach ($preferenceOptions as $option) {
                    DB::table('question_options')->insert([
                        'question_id' => $questionId,
                        'option_text' => $option['text'],
                        'score' => $option['score'],
                    ]);
                }
            } elseif ($question['type'] === 'multiple_choice' || $question['type'] === 'image_choice') {
                foreach ($question['options'] as $option) {
                    DB::table('question_options')->insert([
                        'question_id' => $questionId,
                        'option_text' => $option['text'],
                        'score' => $option['score'],
                    ]);
                }
            }
        }

        $total = DB::table('questions')->count();
        $this->command->info("QuestionSeeder berhasil. Total questions: {$total}");
    }
}
