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
        Schema::create('movie_pcompanies', function (Blueprint $table) {
            $table->id();
            $table->integer('movie_id')->references('id')->on('movies');
            $table->integer('pcompany_id')->references('id')->on('pcompanies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_pcompanies');
    }
};
