<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_barang');
            $table->string('nama_peminjam', 100);
            $table->string('nohp', 20);
            $table->string('email', 100);
            $table->integer('jumlah');
            $table->dateTime('tanggal_dibuat')->nullable();
            $table->dateTime('tanggal_diperbarui')->nullable();

            $table->foreign('id_barang')
                  ->references('id')
                  ->on('barang')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
