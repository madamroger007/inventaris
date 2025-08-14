<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatBarang extends Model
{
    protected $table = 'riwayat_barang';
    public $timestamps = false; // gunakan kolom tanggal sendiri
    protected $fillable = [
        'id_peminjam',
        'id_pengembalian',
        'kondisi',
        'tanggal_dibuat',
        'tanggal_diperbarui',
    ];

    protected static function booted()
    {
        static::deleting(function ($riwayat) {
            // Hapus data pengembalian jika ada
            if ($riwayat->pengembalian) {
                $riwayat->pengembalian->delete();
            }

            // Hapus data peminjaman jika ada
            if ($riwayat->peminjaman) {
                $riwayat->peminjaman->delete();
            }
        });
    }
    // Relasi ke peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjam');
    }

    // Relasi ke pengembalian
    public function pengembalian()
    {
        return $this->belongsTo(Pengembalian::class, 'id_pengembalian');
    }
}
