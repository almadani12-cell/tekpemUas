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
        Schema::create('user_quiz_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('pillar_id')->constrained()->onDelete('cascade');
            $table->integer('unlocked_level')->default(1);
            $table->decimal('best_score_level_1', 5, 2)->nullable();
            $table->decimal('best_score_level_2', 5, 2)->nullable();
            $table->decimal('best_score_level_3', 5, 2)->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'pillar_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_quiz_progress');
    }
};
