<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalian';
    protected $primaryKey = 'id';
    public $timestamps = true;
    const CREATED_AT = 'tanggal_dibuat';
    const UPDATED_AT = null;
    protected $fillable = [
        'id_peminjam',
        'kondisi',
        'tanggal_dibuat'
    ];

    // Relasi: Pengembalian milik satu peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjam');
    }

    // Relasi ke riwayat barang
    public function riwayatBarang()
    {
        return $this->hasMany(RiwayatBarang::class, 'id_pengembalian');
    }
}
