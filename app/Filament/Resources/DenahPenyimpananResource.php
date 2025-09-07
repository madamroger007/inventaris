<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DenahPenyimpananResource\Pages;
use App\Filament\Resources\DenahPenyimpananResource\RelationManagers;
use App\Models\DenahPenyimpanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;

class DenahPenyimpananResource extends Resource
{
    protected static ?string $model = DenahPenyimpanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Lokasi Penyimpanan';
    protected static ?string $pluralLabel = 'Lokasi Penyimpanan';
    protected static ?string $navigationGroup = 'Inventaris';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Bagian gambar denah, full row
                ViewField::make('denah_gambar')
                    ->view('filament.components.denah-gambar')
                    ->columnSpanFull(), // biar full width

                // Bagian form input dengan 2 kolom
                Grid::make(2)
                    ->schema([
                        TextInput::make('kode_denah')
                            ->label('Kode Denah')
                            ->required(),

                        TextInput::make('label')
                            ->label('Label')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_denah')->label('Kode Denah')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('label')->label('Label')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('tanggal_dibuat')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_diperbarui')
                    ->label('Diubah Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDenahPenyimpanans::route('/'),
            'create' => Pages\CreateDenahPenyimpanan::route('/create'),
            'edit' => Pages\EditDenahPenyimpanan::route('/{record}/edit'),
        ];
    }
}
