<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Models\Barang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationLabel = 'Data Barang';
    protected static ?string $pluralLabel = 'Data Barang';
    protected static ?string $navigationGroup = 'Inventaris';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Barang')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('kategori')
                    ->label('Kategori Barang')
                    ->required()
                    ->maxLength(50),

                Forms\Components\TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('kondisi')
                    ->label('Kondisi Barang')
                    ->required()
                    ->maxLength(50),

                Forms\Components\FileUpload::make('gambar')
                    ->label('Foto Barang')
                    ->image()
                    ->directory('barang-images')
                    ->disk('public')
                    ->visibility('public')
                    ->preserveFilenames(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama Barang')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('kategori')->label('Kategori')->sortable(),
                Tables\Columns\TextColumn::make('jumlah')->label('Jumlah')->sortable(),
                Tables\Columns\TextColumn::make('kondisi')->label('Kondisi'),
                Tables\Columns\ViewColumn::make('gambar')
                    ->label('Foto')
                    ->view('tables.columns.zoom-image')
                    ->extraAttributes(['onclick' => 'event.stopPropagation()']),
                Tables\Columns\TextColumn::make('tanggal_dibuat')->label('Tanggal Dibuat')->dateTime(),
                Tables\Columns\TextColumn::make('tanggal_diperbarui')->label('Tanggal Diperbarui')->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
