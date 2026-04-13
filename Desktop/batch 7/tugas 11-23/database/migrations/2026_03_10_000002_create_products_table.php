<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Sesuai Tugas

            // 🔥 RELASI KE CATEGORY (Biar struktur DB kamu pro)
            $table->foreignId('category_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('nama_produk'); // Nama Produk

            // ⚡ FIX: Nama kolom ganti jadi 'description' sesuai Tugas 13
            $table->text('description')->nullable();

            // ⚡ IMPROVE: Pakai unsigned() biar harga & stok gak bisa minus
            $table->integer('harga')->unsigned();
            $table->integer('stok')->unsigned();

            // ⚡ IMAGE: Tetap string, nullable biar aman pas testing
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};