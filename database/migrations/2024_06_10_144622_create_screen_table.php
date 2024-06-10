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
        Schema::create('screen', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('column_size');
            $table->integer('row_size');
            $table->unsignedBigInteger('cinema_id');
            $table->timestamps();

            $table->foreign('cinema_id')->references('id')->on('cinema')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('screen');
    }
};