<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class APIController extends Controller
{
    protected $barang;
    protected $peminjaman;

    public function __construct(Barang $barang)
    {

        $this->barang = $barang;
    }

    public function getBarang()
    {
        $data_barang = $this->barang->with('denah')->get();
        return response()->json($data_barang);
    }
}
