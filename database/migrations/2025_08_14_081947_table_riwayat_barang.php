<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('riwayat_barang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peminjam');
            $table->unsignedBigInteger('id_pengembalian')->nullable();
            $table->dateTime('tanggal_diperbarui')->nullable();
            $table->dateTime('tanggal_dibuat')->nullable();

            $table->foreign('id_peminjam')
                  ->references('id')
                  ->on('peminjaman')
                  ->onDelete('cascade');

            $table->foreign('id_pengembalian')
                  ->references('id')
                  ->on('pengembalian')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_barang');
    }
};
