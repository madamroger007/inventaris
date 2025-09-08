<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DenahPenyimpanan extends Model
{

    protected $table = 'denah_penyimpanan';
    protected $primaryKey = 'id';
    public $timestamps = true; // Karena kita pakai tanggal_dibuat & tanggal_diperbarui manual
    const CREATED_AT = 'tanggal_dibuat';
    const UPDATED_AT = 'tanggal_diperbarui';
    protected $fillable = [
        'kode_denah',
        'label',
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_denah', 'id');
    }
}
