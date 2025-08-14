<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peminjam');
            $table->string('kondisi', 50);
            $table->dateTime('tanggal_dibuat')->nullable();

            $table->foreign('id_peminjam')
                  ->references('id')
                  ->on('peminjaman')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};
