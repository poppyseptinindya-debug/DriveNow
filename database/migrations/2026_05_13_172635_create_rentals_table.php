<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained('cars')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal_sewa');
            $table->integer('lama_sewa');
            $table->integer('total_harga');
            $table->enum('status_penyewaan', ['menunggu_konfirmasi', 'menunggu_pembayaran', 'menunggu_pengambilan', 'sedang_disewa', 'selesai', 'ditolak'])->default('menunggu_konfirmasi');
            $table->enum('metode_pembayaran', ['Transfer Bank', 'Cash']);
            $table->string('bukti_transfer')->nullable();
            $table->integer('rating')->nullable();
            $table->text('review')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
