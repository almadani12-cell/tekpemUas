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
        Schema::table('quiz_answers', function (Blueprint $table) {
            $table->json('selected_options')->nullable()->after('selected_option_id');
            $table->integer('points_earned')->default(0)->after('is_correct');
            $table->string('question_identifier')->nullable()->after('question_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quiz_answers', function (Blueprint $table) {
            $table->dropColumn(['selected_options', 'points_earned', 'question_identifier']);
        });
    }
};
