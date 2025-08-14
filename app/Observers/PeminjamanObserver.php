<?php

namespace App\Observers;

use App\Models\Peminjaman;
use App\Models\RiwayatBarang;

class PeminjamanObserver
{
    /**
     * Handle the Peminjaman "created" event.
     */
    public function created(Peminjaman $peminjaman): void
    {
        // Buat riwayat barang baru saat peminjaman dibuat
        RiwayatBarang::create([
            'id_peminjam' => $peminjaman->id,
            'id_pengembalian' => null,       // belum ada pengembalian
            'kondisi' => $peminjaman->barang->kondisi ?? null, // ambil dari barang
            'tanggal_dibuat' => now(),
            'tanggal_diperbarui' => null,
        ]);
    }

    /**
     * Handle the Peminjaman "updated" event.
     */
    public function updated(Peminjaman $peminjaman): void
    {
        //
    }

    /**
     * Handle the Peminjaman "deleted" event.
     */
    public function deleted(Peminjaman $peminjaman): void
    {
        //
    }

    /**
     * Handle the Peminjaman "restored" event.
     */
    public function restored(Peminjaman $peminjaman): void
    {
        //
    }

    /**
     * Handle the Peminjaman "force deleted" event.
     */
    public function forceDeleted(Peminjaman $peminjaman): void
    {
        //
    }
}
