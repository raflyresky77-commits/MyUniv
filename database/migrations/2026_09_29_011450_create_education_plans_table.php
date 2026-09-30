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
        Schema::create('education_plans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('student_id')->constrained()->cascadeOnDelete();
    $table->foreignId('target_major_id')->nullable()->constrained('majors')->nullOnDelete();
    $table->foreignId('alternative_major_id')->nullable()->constrained('majors')->nullOnDelete();
    $table->foreignId('target_university_id')->nullable()->constrained('universities')->nullOnDelete();
    $table->foreignId('alternative_university_id')->nullable()->constrained('universities')->nullOnDelete();
    $table->string('status')->default('pending'); // pending, in_progress, completed
    $table->text('notes')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_plans');
    }
};
