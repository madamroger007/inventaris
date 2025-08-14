<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id(); // id (Primary Key)
            $table->string('nama', 100);
            $table->string('kategori', 50);
            $table->integer('jumlah');
            $table->string('kondisi', 50);
            $table->string('gambar', 255)->nullable();
            $table->dateTime('tanggal_dibuat')->nullable();
            $table->dateTime('tanggal_diperbarui')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
