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
    protected static function booted()
    {
        static::creating(function ($barang) {
            if (!$barang->kode_barang) {
                $barang->kode_barang = self::generateKode($barang->id_denah);
            }
        });
    }

    private static function generateKode($id_denah)
    {
        // Ambil kode denah dari relasi
        $denah = DenahPenyimpanan::find($id_denah);
        if (!$denah || !$denah->kode_denah) {
            throw new \Exception("Kode denah tidak ditemukan untuk id_denah: {$id_denah}");
        }

        $prefix = $denah->kode_denah; // ganti prefix dari kode denah, bukan "P"

        $lastBarang = self::where('id_denah', $id_denah)
            ->orderBy('id', 'desc')
            ->lockForUpdate() // tambah ini biar aman di transaksi
            ->first();

        $lastNumber = ($lastBarang && preg_match('/(\d+)$/', $lastBarang->kode_barang, $matches))
            ? (int) $matches[1]
            : 0;

        $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

        return $prefix . '-' . $newNumber;
    }


    // Relasi: Barang bisa dipinjam banyak kali
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_barang');
    }

    // Relasi: Barang milik satu DenahPenyimpanan
    public function denah()
    {
        return $this->belongsTo(DenahPenyimpanan::class, 'id_denah', 'id');
    }
}
