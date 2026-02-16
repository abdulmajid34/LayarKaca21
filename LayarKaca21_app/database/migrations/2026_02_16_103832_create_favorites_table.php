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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('movie_id'); // ID dari TMDB
            $table->string('title')->nullable(); // Optional: Simpan judul untuk cache sederhana
            $table->string('poster_path')->nullable(); // Optional: Simpan path gambar
            $table->timestamps();
            
            // Mencegah duplikasi: 1 user hanya bisa favoritkan 1 movie ID yang sama satu kali
            $table->unique(['user_id', 'movie_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
