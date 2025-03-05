<?php

namespace App\Filament\Admin\Resources\BantuanRastraResource\Pages;

use App\Filament\Admin\Resources\BantuanRastraResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBantuanRastra extends EditRecord
{
    protected static string $resource = BantuanRastraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
