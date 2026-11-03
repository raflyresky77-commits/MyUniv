<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('universities', function (Blueprint $table) {
            if (!Schema::hasColumn('universities', 'ranking')) {
                $table->unsignedInteger('ranking')->nullable();
            }
            if (!Schema::hasColumn('universities', 'ranking_source')) {
                $table->string('ranking_source', 30)->nullable();
            }
            if (!Schema::hasColumn('universities', 'ranking_year')) {
                $table->unsignedSmallInteger('ranking_year')->nullable();
            }
            if (!Schema::hasColumn('universities', 'ranking_category')) {
                $table->string('ranking_category')->nullable();
            }
            if (!Schema::hasColumn('universities', 'ranking_url')) {
                $table->text('ranking_url')->nullable();
            }
            if (!Schema::hasColumn('universities', 'accreditation')) {
                $table->string('accreditation')->nullable();
            }
            if (!Schema::hasColumn('universities', 'branch_notes')) {
                $table->text('branch_notes')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('universities', function (Blueprint $table) {
            foreach (['ranking', 'ranking_source', 'ranking_year', 'ranking_category', 'ranking_url', 'accreditation', 'branch_notes'] as $column) {
                if (Schema::hasColumn('universities', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
