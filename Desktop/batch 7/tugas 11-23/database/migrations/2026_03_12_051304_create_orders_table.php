<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration untuk tabel Pesanan (Orders).
     * Gabungan Fitur Checkout, Midtrans, dan Tracking (Tugas 24)
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); 

            // --- RELASI DATA ---
            // Menghubungkan pesanan ke User dan Produk tertentu
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); 

            // --- DETAIL TRANSAKSI ---
            // order_number wajib unik untuk integrasi Midtrans Snap
            $table->string('order_number')->unique(); 
            $table->integer('quantity');
            // Menggunakan decimal agar perhitungan diskon/pajak nantinya lebih akurat
            $table->decimal('total_price', 15, 2); 

            // --- FITUR PAYMENT GATEWAY & TRACKING (TUGAS 24) ---
            // Status awal adalah pending sampai dibayar oleh user
            $table->string('status')->default('pending'); 
            $table->string('payment_method')->nullable();
            
            // snap_token disimpan agar user bisa melanjutkan pembayaran tanpa generate ulang
            $table->string('snap_token')->nullable(); 
            
            // resi_number digunakan untuk fitur tracking barang dikirim
            $table->string('resi_number')->nullable(); 

            $table->timestamps();
        });
    }

    /**
     * Balikkan migration (Rollback).
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};