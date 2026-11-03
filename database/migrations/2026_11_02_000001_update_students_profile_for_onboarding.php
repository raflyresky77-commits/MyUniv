<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'class')) {
                $table->string('class', 50)->nullable();
            }

            if (Schema::hasColumn('students', 'school_origin')) {
                $table->dropColumn('school_origin');
            }

            // Address dipakai untuk kota/daerah domisili, bukan alamat rumah lengkap.
            // Kolom existing tetap dipertahankan agar data lama tidak terhapus.
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'school_origin')) {
                $table->string('school_origin')->nullable();
            }

            if (Schema::hasColumn('students', 'class')) {
                $table->dropColumn('class');
            }
        });
    }
};
