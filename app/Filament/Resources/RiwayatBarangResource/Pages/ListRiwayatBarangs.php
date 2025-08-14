<?php

namespace App\Filament\Resources\RiwayatBarangResource\Pages;

use App\Filament\Resources\RiwayatBarangResource;
use App\Services\RiwayatExportService;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;

class ListRiwayatBarangs extends ListRecords
{
    protected static string $resource = RiwayatBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export_pdf')
                ->label('Export PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->button()
                ->action(function () {
                    // Ambil data
                    $records = \App\Models\RiwayatBarang::with([
                        'peminjaman',
                        'pengembalian',
                        'peminjaman.barang'
                    ])->get();

                    // Bersihkan teks
                    $records = $records->map(function ($item) {
                        $item->peminjaman->nama_peminjam = mb_convert_encoding($item->peminjaman->nama_peminjam ?? '', 'UTF-8', 'UTF-8');
                        $item->peminjaman->barang->nama = mb_convert_encoding($item->peminjaman->barang->nama ?? '', 'UTF-8', 'UTF-8');
                        $item->pengembalian->kondisi = mb_convert_encoding($item->pengembalian->kondisi ?? '', 'UTF-8', 'UTF-8');
                        return $item;
                    });

                    // Panggil service export PDF
                    $pdf = RiwayatExportService::export($records);

                    // Kembalikan download
                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->output();
                    }, 'riwayat_barang.pdf');
                }),
        ];
    }
}
