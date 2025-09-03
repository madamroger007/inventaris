<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeminjamanRequest;
use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $barang;
    protected $peminjaman;

    public function __construct(Barang $barang, Peminjaman $peminjaman)
    {
        $this->middleware('auth');
        $this->barang = $barang;
        $this->peminjaman = $peminjaman;
    }

    public function index()
    {
        $data_barang = $this->barang->all();
        return view("peminjaman", compact("data_barang"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PeminjamanRequest $request)
    {
        $validated = $request->validated();

        // Cari barang yang dipinjam
        $barang = $this->barang->findOrFail($validated['id_barang']);

        // Cek apakah stok cukup
        if ($barang->jumlah < $validated['jumlah']) {
            return redirect()->back()->withErrors([
                'jumlah' => 'Stok barang tidak mencukupi. Stok tersedia: ' . $barang->jumlah,
            ])->withInput();
        }

        // Kurangi stok barang
        $barang->jumlah -= $validated['jumlah'];
        $barang->save();

        // Simpan data peminjaman
        $this->peminjaman->create($validated);

        return redirect()->route("peminjaman.index")
            ->with("success", "Data peminjaman berhasil disimpan dan stok barang diperbarui.");
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
