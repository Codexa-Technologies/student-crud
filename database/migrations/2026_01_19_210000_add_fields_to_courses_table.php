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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('course_code')->nullable()->unique()->after('id');
            $table->date('start_date')->nullable()->after('description');
            $table->string('duration')->nullable()->after('start_date');
            $table->string('leader')->nullable()->after('duration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropUnique(['course_code']);
            $table->dropColumn(['course_code', 'start_date', 'duration', 'leader']);
        });
    }
};
