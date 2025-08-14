<?php

namespace App\Services;

use App\Models\RiwayatBarang;
use Barryvdh\DomPDF\Facade\Pdf;

class RiwayatExportService
{
    /**
     * Export data riwayat barang ke PDF
     *
     * @param \Illuminate\Support\Collection|null $records
     * @return \Barryvdh\DomPDF\PDF
     */
    public static function export($records = null)
    {
        // Jika tidak ada records, ambil semua
        if (!$records) {
            $records = RiwayatBarang::with(['peminjaman', 'pengembalian', 'peminjaman.barang'])
                ->orderBy('id', 'desc')
                ->get();
        }

        // Generate PDF menggunakan view
        $pdf = Pdf::loadView('filament.components.riwayat_barang_pdf', [
            'records' => $records
        ])->setPaper('a4', 'landscape');

        return $pdf;
    }
}
