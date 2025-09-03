<?php

namespace App\Filament\Resources\DenahPenyimpananResource\Pages;

use App\Filament\Resources\DenahPenyimpananResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDenahPenyimpanan extends EditRecord
{
    protected static string $resource = DenahPenyimpananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
