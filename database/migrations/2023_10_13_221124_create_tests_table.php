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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('test_reference_id');
            $table->char('description', 100);
            $table->float('value', 10, 1);
            $table->char('unit', 20);
            $table->date('date');
            $table->text('note')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('test_reference_id')->references('id')->on('test_references');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
