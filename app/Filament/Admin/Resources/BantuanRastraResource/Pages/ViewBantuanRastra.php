<?php

namespace App\Filament\Admin\Resources\BantuanRastraResource\Pages;

use App\Filament\Admin\Resources\BantuanRastraResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBantuanRastra extends ViewRecord
{
    protected static string $resource = BantuanRastraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
