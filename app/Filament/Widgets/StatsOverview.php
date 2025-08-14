<?php

namespace App\Filament\Widgets;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Jumlah Barang', Barang::count())
                ->description('Total barang yang tersedia')
                ->descriptionIcon('heroicon-o-archive-box')
                ->color('primary'),

            Card::make('Jumlah Peminjaman', Peminjaman::count())
                ->description('Total transaksi peminjaman')
                ->descriptionIcon('heroicon-o-arrow-down-tray')
                ->color('warning'),

            Card::make('Jumlah Pengembalian', Pengembalian::count())
                ->description('Total barang yang dikembalikan')
                ->descriptionIcon('heroicon-o-arrow-up-tray')
                ->color('success'),
        ];
    }
}
