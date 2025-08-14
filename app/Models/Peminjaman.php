<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id';
    public $timestamps = true;
    const CREATED_AT = 'tanggal_dibuat';
    const UPDATED_AT = 'tanggal_diperbarui';

    protected $fillable = [
        'id_barang',
        'nama_peminjam',
        'nohp',
        'email',
        'jumlah',
        'tanggal_dibuat',
        'tanggal_diperbarui'
    ];

    // Relasi: Peminjaman milik satu Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    // Relasi: Satu peminjaman bisa punya satu pengembalian
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'id_peminjam');
    }

    // Relasi ke riwayat barang
    public function riwayatBarang()
    {
        return $this->hasMany(RiwayatBarang::class, 'id_peminjam');
    }
}
