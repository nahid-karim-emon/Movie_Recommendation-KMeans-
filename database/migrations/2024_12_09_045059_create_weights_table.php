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
        Schema::create('weights', function (Blueprint $table) {
            $table->id();
            $weights = [
                'content_based' => 0.8,
                'collaborative' => 0.5,
                'collaborative_likes' => 0.5,
                'demographic' => 0.3,
            ];
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->float('content_based')->default($weights['content_based']);
            $table->float('collaborative')->default($weights['collaborative']);
            $table->float('collaborative_likes')->default($weights['collaborative_likes']);
            $table->float('demographic')->default($weights['demographic']);
            $table->unique('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weights');
    }
};
