<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    public $timestamps = true; // Karena kita pakai tanggal_dibuat & tanggal_diperbarui manual
    const CREATED_AT = 'tanggal_dibuat';
    const UPDATED_AT = 'tanggal_diperbarui';
    protected $fillable = [
        'nama',
        'kode_barang',
        'kategori',
        'jumlah',
        'kondisi',
        'gambar',
        'id_denah' // Menambahkan field id_denah ke fillable
    ];

    // Relasi: Barang bisa dipinjam banyak kali
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_barang');
    }

    // Relasi: Barang milik satu DenahPenyimpanan
    public function denahPenyimpanan()
    {
        return $this->belongsTo(DenahPenyimpanan::class, 'id_denah');
    }
}
