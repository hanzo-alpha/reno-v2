<?php

namespace App\Filament\Admin\Resources\BantuanRastraResource\Pages;

use App\Filament\Admin\Resources\BantuanRastraResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBantuanRastras extends ListRecords
{
    protected static string $resource = BantuanRastraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
