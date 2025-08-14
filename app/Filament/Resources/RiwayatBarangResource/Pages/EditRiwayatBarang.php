<?php

namespace App\Filament\Resources\RiwayatBarangResource\Pages;

use App\Filament\Resources\RiwayatBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRiwayatBarang extends EditRecord
{
    protected static string $resource = RiwayatBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
