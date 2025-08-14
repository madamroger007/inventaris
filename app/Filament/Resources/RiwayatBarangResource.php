<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RiwayatBarangResource\Pages;
use App\Models\RiwayatBarang;
use Filament\Forms;
use Filament\Resources\Resource;

use Filament\Tables\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;

use Filament\Tables\Columns\TextColumn;


class RiwayatBarangResource extends Resource
{
    protected static ?string $model = RiwayatBarang::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationLabel = 'Riwayat Barang';
    protected static ?string $pluralLabel = 'Riwayat Barang';
    protected static ?string $modelLabel = 'Riwayat Barang';
    protected static ?string $navigationGroup = 'Inventaris';

    // Hanya tabel, tidak ada form create/edit
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form; // kosong, karena resource ini read-only
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('peminjaman.nama_peminjam')
                    ->label('Nama Peminjam')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('peminjaman.barang.nama')
                    ->label('Barang')
                    ->sortable()
                    ->searchable(), // sequential search

                TextColumn::make('peminjaman.tanggal_dibuat')
                    ->label('Tanggal Pinjam')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('kondisi')
                    ->label('Kondisi Barang')
                    ->sortable(),

                TextColumn::make('pengembalian.tanggal_dibuat')
                    ->label('Tanggal Kembali')
                    ->dateTime(),
            ])
            ->actions([
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->filters([
                //
            ])
            ->defaultSort('peminjaman.tanggal_dibuat', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRiwayatBarangs::route('/'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->with([
                'peminjaman',               // relasi langsung
                'peminjaman.barang',
                'pengembalian',             // relasi langsung
                'pengembalian.peminjaman',  // relasi melalui pengembalian
            ]);
    }
}
