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
        Schema::table('riwayat_barang', function (Blueprint $table) {
            $table->string('kondisi')->nullable()->after('id_pengembalian');
        });
    }

    public function down(): void
    {
        Schema::table('riwayat_barang', function (Blueprint $table) {
            $table->dropColumn('kondisi');
        });
    }
};
