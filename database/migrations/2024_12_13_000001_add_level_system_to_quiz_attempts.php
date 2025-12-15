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
        Schema::table('quiz_attempts', function (Blueprint $table) {
            $table->integer('level')->default(1)->after('quiz_id');
            $table->integer('points_earned')->default(0)->after('score');
            $table->integer('max_points')->default(0)->after('points_earned');
            $table->decimal('percentage', 5, 2)->default(0)->after('max_points');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quiz_attempts', function (Blueprint $table) {
            $table->dropColumn(['level', 'points_earned', 'max_points', 'percentage']);
        });
    }
};
