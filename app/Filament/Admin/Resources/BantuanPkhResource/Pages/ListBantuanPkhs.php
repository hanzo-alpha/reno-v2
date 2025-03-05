<?php

namespace App\Filament\Admin\Resources\BantuanPkhResource\Pages;

use App\Filament\Admin\Resources\BantuanPkhResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBantuanPkhs extends ListRecords
{
    protected static string $resource = BantuanPkhResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
