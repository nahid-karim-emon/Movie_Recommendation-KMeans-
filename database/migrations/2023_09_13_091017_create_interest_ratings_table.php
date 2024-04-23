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
        Schema::create('interest_ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('interest_id')->references('id')->on('interests');
            $table->integer('rating_id')->references('rating_id')->on('movie_ratings');
            $table->float('ratings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interest_ratings');
    }
};
