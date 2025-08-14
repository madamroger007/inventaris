<?php

namespace App\Observers;

use App\Models\Pengembalian;
use App\Models\RiwayatBarang;

class PengembalianObserver
{
    /**
     * Handle the Pengembalian "created" event.
     */
    public function created(Pengembalian $pengembalian): void
    {
        // Cari riwayat barang berdasarkan peminjaman
        $riwayat = RiwayatBarang::where('id_peminjam', $pengembalian->id_peminjam)->first();

        if ($riwayat) {
            // Update kolom pengembalian dan tanggal diperbarui
            $riwayat->update([
                'id_pengembalian' => $pengembalian->id,
                'kondisi' => $pengembalian->kondisi, // update kondisi sesuai saat kembali
                'tanggal_dibuat' => now(),
            ]);
        } else {
            // Jika tidak ada riwayat sebelumnya, buat baru
            RiwayatBarang::create([
                'id_peminjam' => $pengembalian->id_peminjam,
                'id_pengembalian' => $pengembalian->id,
                'kondisi' => $pengembalian->kondisi,
                'tanggal_dibuat' => now(),
            ]);
        }
    }

    /**
     * Handle the Pengembalian "updated" event.
     */
    public function updated(Pengembalian $pengembalian): void
    {
        //
    }

    /**
     * Handle the Pengembalian "deleted" event.
     */
    public function deleted(Pengembalian $pengembalian): void
    {
        //
    }

    /**
     * Handle the Pengembalian "restored" event.
     */
    public function restored(Pengembalian $pengembalian): void
    {
        //
    }

    /**
     * Handle the Pengembalian "force deleted" event.
     */
    public function forceDeleted(Pengembalian $pengembalian): void
    {
        //
    }
}
