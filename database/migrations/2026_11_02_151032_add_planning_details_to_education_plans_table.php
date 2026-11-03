<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('education_plans', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('admission_path')->nullable();
            $table->string('career')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('education_plans', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'description',
                'admission_path',
                'career',
            ]);
        });
    }
};
