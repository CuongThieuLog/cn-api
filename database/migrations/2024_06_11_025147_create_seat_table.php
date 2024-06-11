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
        Schema::create('seat', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('row');
            $table->integer('column');
            $table->string('seat_type');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('screen_id');
            $table->timestamps();

            $table->foreign('screen_id')->references('id')->on('screen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seat');
    }
};
