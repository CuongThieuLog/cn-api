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
        Schema::create('movie', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('national');
            $table->date('released_at');
            $table->string('language_movie');
            $table->integer('duration'); 
            $table->integer('limit_age');
            $table->text('brief_movie'); 
            $table->string('trailer_movie');
            $table->unsignedBigInteger('movie_type_id');
            $table->unsignedBigInteger('movie_format_id');
            $table->integer('ticket_price'); 
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('movie_type_id')->references('id')->on('movie_type')->onDelete('cascade');
            $table->foreign('movie_format_id')->references('id')->on('movie_format')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie');
    }
};