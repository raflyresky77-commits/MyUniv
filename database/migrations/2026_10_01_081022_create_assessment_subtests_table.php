<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessment_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('assessment_type', 40);
            $table->jsonb('responses');
            $table->timestampTz('submitted_at')->useCurrent();
            $table->timestampsTz();

            $table->unique(['user_id', 'assessment_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_submissions');
    }
};
