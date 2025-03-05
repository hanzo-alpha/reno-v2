<?php

namespace App\Filament\Admin\Resources\BantuanPpksResource\Pages;

use App\Filament\Admin\Resources\BantuanPpksResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBantuanPpks extends ViewRecord
{
    protected static string $resource = BantuanPpksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
