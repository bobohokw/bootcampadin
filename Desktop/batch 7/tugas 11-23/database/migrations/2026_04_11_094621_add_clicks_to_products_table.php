<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * ✅ MENAMBAHKAN KOLOM CLICKS (TUGAS 23)
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Menambah kolom clicks dengan tipe data integer dan nilai awal 0
            // Diletakkan setelah kolom 'image' agar struktur DB rapi
            $table->integer('clicks')->default(0)->after('image'); 
        });
    }

    /**
     * Reverse the migrations.
     * ✅ MENGHAPUS KOLOM JIKA ROLLBACK
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Menghapus kolom clicks jika migration di-rollback (php artisan migrate:rollback)
            $table->dropColumn('clicks');
        });
    }
};