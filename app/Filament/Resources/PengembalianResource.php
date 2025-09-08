<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengembalianResource\Pages;
use App\Models\Pengembalian;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PengembalianResource extends Resource
{
    protected static ?string $model = Pengembalian::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-uturn-left';
    protected static ?string $navigationLabel = 'Pengembalian Barang';
    protected static ?string $pluralLabel = 'Pengembalian';
    protected static ?string $modelLabel = 'Pengembalian';
    protected static ?string $navigationGroup = 'Inventaris';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)->schema([

                    // Pilih peminjaman
                    Select::make('id_peminjam')
                        ->label('Peminjaman')
                        ->options(
                            \App\Models\Peminjaman::with('barang')
                                ->get()
                                ->mapWithKeys(fn($p) => [
                                    $p->id => $p->nama_peminjam . ' - ' . $p->barang->nama . ' - ' . $p->jumlah
                                ])
                        )
                        ->searchable()
                        ->required(),

                    // Kondisi barang
                    Select::make('kondisi')
                        ->label('Kondisi Pengembalian Barang')
                        ->options([
                            'Baik' => 'Baik',
                            'Rusak' => 'Rusak',
                            'Hilang' => 'Hilang',
                        ])
                        ->required()
                        ->native(false),
                ]),
            ]);
    }


    public static function getPages(): array
    {
        return [
            // 'index' => Pages\ListPengembalians::route('/'),
            'index' => Pages\CreatePengembalian::route('/create'),
            'edit' => Pages\EditPengembalian::route('/{record}/edit'),
        ];
    }
}
