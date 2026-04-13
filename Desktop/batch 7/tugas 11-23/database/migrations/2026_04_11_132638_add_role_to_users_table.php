<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk menambah kolom role.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom role setelah kolom email
            // Default 'user' agar semua akun baru otomatis jadi user biasa
            $table->string('role')->default('user')->after('email');
        });
    }

    /**
     * Batalkan migrasi (Hapus kolom role jika di-rollback).
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom role jika migrasi dibatalkan
            $table->dropColumn('role');
        });
    }
};