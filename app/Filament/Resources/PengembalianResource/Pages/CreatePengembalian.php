<?php

namespace App\Filament\Resources\PengembalianResource\Pages;

use App\Filament\Resources\PengembalianResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Peminjaman;
use App\Models\Barang;

class CreatePengembalian extends CreateRecord
{
    protected static string $resource = PengembalianResource::class;
    public function getTitle(): string
    {
        return 'Pengembalian Barang';
    }

    protected function afterCreate(): void
    {
        $pengembalian = $this->record;

        // Ambil data peminjaman
        $peminjaman = Peminjaman::with('barang')->find($pengembalian->id_peminjam);

        if ($peminjaman && $peminjaman->barang) {
            $barang = $peminjaman->barang;

            if ($pengembalian->kondisi !== 'Hilang') {
                $barang->jumlah += $peminjaman->jumlah;
                $barang->save();
            }
        }
    }
}
