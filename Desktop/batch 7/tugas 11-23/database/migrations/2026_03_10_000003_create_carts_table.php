<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->foreignId('product_id')->constrained()->cascadeOnDelete();

            // 🔥 lebih aman
            $table->integer('qty')->unsigned()->default(1);

            // 🔥 optional (biar ga duplicate)
            $table->unique(['user_id','product_id']);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};