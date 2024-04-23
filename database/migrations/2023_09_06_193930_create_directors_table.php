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
        Schema::create('directors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender');
            $table->longText('bio');
            $table->string('country');
            $table->date('dob');
            $table->string('photo')->nullable();
            $table->date('deathd')->nullable('true');
            $table->string('education')->nullable('true');
            $table->string('spouse')->nullable('true');
            $table->integer('spouse_id')->nullable('true');
            $table->string('children')->nullable('true');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('directors');
    }
};
