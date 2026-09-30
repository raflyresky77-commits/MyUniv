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
        Schema::create('plan_checklists', function (Blueprint $table) {
    $table->id();
    $table->foreignId('plan_id')->constrained('education_plans')->cascadeOnDelete();
    $table->string('title');
    $table->boolean('is_completed')->default(false);
    $table->date('deadline')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_checklists');
    }
};
