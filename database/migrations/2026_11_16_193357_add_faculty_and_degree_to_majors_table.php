<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('majors', function (Blueprint $table) {
            if (!Schema::hasColumn('majors', 'faculty')) {
                $table->string('faculty')->nullable();
            }

            if (!Schema::hasColumn('majors', 'degree')) {
                $table->string('degree')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('majors', function (Blueprint $table) {
            $columns = [];

            if (Schema::hasColumn('majors', 'faculty')) {
                $columns[] = 'faculty';
            }

            if (Schema::hasColumn('majors', 'degree')) {
                $columns[] = 'degree';
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};
