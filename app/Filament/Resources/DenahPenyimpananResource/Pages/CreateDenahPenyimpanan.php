<?php

namespace App\Filament\Resources\DenahPenyimpananResource\Pages;

use App\Filament\Resources\DenahPenyimpananResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDenahPenyimpanan extends CreateRecord
{
    protected static string $resource = DenahPenyimpananResource::class;
    public function getTitle(): string
    {
        return 'Tambah Lokasi Penyimpanan';
    }
}
