<?php

namespace App\Filament\Resources\RiwayatBarangResource\Pages;

use App\Filament\Resources\RiwayatBarangResource;
use App\Services\RiwayatExportService;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Collection;
use App\Models\RiwayatBarang;

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

                        if ($item->pengembalian) { // pastikan relasi ada
                            $item->pengembalian->kondisi = mb_convert_encoding($item->pengembalian->kondisi ?? '', 'UTF-8', 'UTF-8');
                        }

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

    public function getTableRecords(): Collection
    {
        $search = $this->tableSearch; // Keyword search dari Filament
        $allRecords = RiwayatBarang::with([
            'peminjaman',
            'peminjaman.barang',
            'pengembalian',
            'pengembalian.peminjaman',
        ])->get();

        if ($search) {
            $allRecords = $allRecords->filter(function ($item) use ($search) {
                return $this->sequentialSearch(optional($item->peminjaman)->nama_peminjam, $search)
                    || $this->sequentialSearch(optional(optional($item->peminjaman)->barang)->nama, $search);
            });
        }

        return $allRecords;
    }

    private function sequentialSearch(?string $text, string $keyword): bool
    {
        if (!$text) {
            return false;
        }

        $text = strtolower($text);
        $keyword = strtolower($keyword);

        $n = strlen($text);
        $m = strlen($keyword);

        for ($i = 0; $i <= $n - $m; $i++) {
            $match = true;
            for ($j = 0; $j < $m; $j++) {
                if ($text[$i + $j] !== $keyword[$j]) {
                    $match = false;
                    break;
                }
            }
            if ($match) {
                return true;
            }
        }

        return false;
    }
}
