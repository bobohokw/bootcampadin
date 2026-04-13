<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration untuk membuat tabel kategori.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Sesuai Tugas (id)
            
            // Menggunakan 'name' agar sesuai instruksi Tugas 13, 
            // tapi tetap pakai unique() supaya kategori tidak duplikat.
            $table->string('name')->unique(); 
            
            $table->timestamps();
        });
    }

    /**
     * Batalkan migration (Rollback).
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};