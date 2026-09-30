<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('university_majors', function (Blueprint $table) {
    $table->id();
    $table->foreignId('university_id')->constrained()->cascadeOnDelete();
    $table->foreignId('major_id')->constrained()->cascadeOnDelete();
    $table->string('accreditation')->nullable(); // A, B, C, Unggul (buat filter FR-008)
    $table->text('additional_info')->nullable();
    $table->timestamps();

    $table->unique(['university_id', 'major_id']);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_majors');
    }
};
