<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeminjamanResource\Pages;
use App\Models\Peminjaman;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\View;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class PeminjamanResource extends Resource
{
    protected static ?string $model = Peminjaman::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';
    protected static ?string $navigationLabel = 'Form Peminjaman';
    protected static ?string $pluralModelLabel = 'Peminjaman';
    protected static ?string $modelLabel = 'Peminjaman';
    protected static ?string $navigationGroup = 'Inventaris';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2) // grid 2 kolom
                    ->schema([
                        Select::make('id_barang')
                            ->label('Barang')
                            ->required()
                            ->searchable()
                            ->options(\App\Models\Barang::all()->pluck('nama', 'id')->toArray())
                            ->reactive(),

                        View::make('gambar_barang')
                            ->label('Gambar Barang')
                            ->view('filament.components.gambar-barang'),

                        TextInput::make('nama_peminjam')
                            ->label('Nama Peminjam')
                            ->maxLength(100)
                            ->required(),

                        TextInput::make('nohp')
                            ->label('Nomor HP')
                            ->maxLength(20)
                            ->required(),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(100)
                            ->required(),

                        TextInput::make('jumlah')
                            ->label('Jumlah Barang')
                            ->numeric()
                            ->required(),
                    ]),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\CreatePeminjaman::route('/create'),
        ];
    }
}
