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
        Schema::create('movie_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to users table
            $table->foreignId('movie_id')->constrained()->onDelete('cascade'); // Link to movies table
            $table->boolean('like')->default(1); // 1 for like, 0 for dislike
            $table->timestamps();

            $table->unique(['user_id', 'movie_id']); // Ensure one like/dislike per user per movie
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_likes');
    }
};
