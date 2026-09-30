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
        Schema::create('assessment_results', function (Blueprint $table) {
    $table->id();
    $table->foreignId('student_id')->constrained()->cascadeOnDelete();
    $table->foreignId('assessment_id')->constrained()->cascadeOnDelete();
    $table->foreignId('category_id')->constrained('interest_categories')->cascadeOnDelete();
    $table->integer('score')->default(0);
    $table->decimal('percentage', 5, 2)->default(0);
    $table->timestamps();

    $table->unique(['student_id', 'assessment_id', 'category_id']);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_results');
    }
};
