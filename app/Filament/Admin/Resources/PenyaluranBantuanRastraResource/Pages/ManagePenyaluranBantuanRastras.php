<?php

namespace App\Filament\Admin\Resources\PenyaluranBantuanRastraResource\Pages;

use App\Filament\Admin\Resources\PenyaluranBantuanRastraResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePenyaluranBantuanRastras extends ManageRecords
{
    protected static string $resource = PenyaluranBantuanRastraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
