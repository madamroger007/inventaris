<?php

namespace App\Filament\Resources\BarangResource\Pages;

use App\Filament\Resources\BarangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Barang;
use Illuminate\Database\Eloquent\Collection;

class ListBarangs extends ListRecords
{
    protected static string $resource = BarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public  function getTableRecords(): Collection
    {
        $search = $this->tableSearch; // Keyword dari input search Filament

        $allRecords = Barang::all();

        if ($search) {
            $allRecords = $allRecords->filter(function ($item) use ($search) {
                return $this->sequentialSearch($item->nama, $search)
                    || $this->sequentialSearch($item->kategori, $search);
            });
        }

        return $allRecords;
    }

    private function sequentialSearch(string $text, string $keyword): bool
    {
        $text = strtolower($text);
        $keyword = strtolower($keyword);

        $n = strlen($text);
        $m = strlen($keyword);

        for ($i = 0; $i <= $n - $m; $i++) {
            $match = true;
            for ($j = 0; $j < $m; $j++) {
                if ($text[$i + $j] !== $keyword[$j]) {
                    $match = false;
                    break;
                }
            }
            if ($match) {
                return true;
            }
        }

        return false;
    }
}
