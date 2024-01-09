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
        Schema::create('test_references', function (Blueprint $table) {
            $table->id();
            $table->string('description', '20');
            $table->integer('score')->nullable();
            $table->char('icon', 30)->nullable();
            $table->char('color', 7)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_references');
    }
};
