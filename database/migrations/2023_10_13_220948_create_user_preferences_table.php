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
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('weight_unit_id');
            $table->unsignedBigInteger('measurement_unit_id');
            $table->unsignedBigInteger('hydration_unit_id');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('date_format_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('weight_unit_id')->references('id')->on('weight_units');
            $table->foreign('measurement_unit_id')->references('id')->on('measurement_units');
            $table->foreign('hydration_unit_id')->references('id')->on('hydration_units');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('date_format_id')->references('id')->on('date_formats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
};
