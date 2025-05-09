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
        Schema::create('pesanan_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pesanan');
            $table->unsignedBigInteger('id_produk');
            $table->integer('jumlah')->default(1);
            
            $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanan')->onDelete('cascade');
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_detail');
    }
};
