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
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('measurement_unit_id');
            $table->unsignedBigInteger('score_id');
            $table->float('neck', 5, 1)->nullable();
            $table->float('left_biceps', 5, 1)->nullable();
            $table->float('right_biceps', 5, 1)->nullable();
            $table->float('left_forearm', 5, 1)->nullable();
            $table->float('right_forearm', 5, 1)->nullable();
            $table->float('chest_bust', 5, 1)->nullable();
            $table->float('abdomen', 5, 1)->nullable();
            $table->float('waist', 5, 1)->nullable();
            $table->float('hips', 5, 1)->nullable();
            $table->float('left_thigh', 5, 1)->nullable();
            $table->float('right_thigh', 5, 1)->nullable();
            $table->float('left_calf', 5, 1)->nullable();
            $table->float('right_calf', 5, 1)->nullable();
            $table->float('left_ankle', 5, 1)->nullable();
            $table->float('right_ankle', 5, 1)->nullable();
            $table->date('date');
            $table->text('note')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('measurement_unit_id')->references('id')->on('measurement_units');
            $table->foreign('score_id')->references('id')->on('scores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};
