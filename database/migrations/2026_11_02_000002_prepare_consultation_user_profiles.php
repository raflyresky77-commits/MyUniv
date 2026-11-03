<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // NISN dapat dilengkapi melalui profil setelah akun siswa dibuat.
        Schema::table('students', function (Blueprint $table) {
            $table->string('nisn')->nullable()->change();
        });

        // Backfill profil untuk akun lama agar relasi konsultasi tidak gagal.
        $now = now();
        $studentUsers = DB::table('users')->where('role_id', 1)->pluck('id');
        foreach ($studentUsers as $userId) {
            DB::table('students')->insertOrIgnore([
                'user_id' => $userId,
                'nisn' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $counselorUsers = DB::table('users')->where('role_id', 2)->pluck('id');
        foreach ($counselorUsers as $userId) {
            DB::table('teacher_bk')->insertOrIgnore([
                'user_id' => $userId,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        // Sengaja tidak menghapus profil hasil backfill atau memaksa NISN menjadi wajib,
        // karena keduanya dapat menyebabkan data akun yang sudah ada tidak valid.
    }
};
