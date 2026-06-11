<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mobil', 100);
            $table->enum('jenis_mobil', ['MPV', 'SUV', 'City Car', 'Sedan']);
            $table->integer('harga_sewa_per_hari');
            $table->enum('status', ['Tersedia', 'Disewakan'])->default('Tersedia');
            $table->string('warna')->nullable();
            $table->integer('tahun')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
