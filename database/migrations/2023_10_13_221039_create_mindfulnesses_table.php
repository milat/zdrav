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
        Schema::create('mindfulnesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('score_id');
            $table->integer('length');
            $table->dateTime('date_time');
            $table->text('note')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('score_id')->references('id')->on('scores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mindfulnesses');
    }
};
