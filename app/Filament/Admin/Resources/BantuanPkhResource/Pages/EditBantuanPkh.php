<?php

namespace App\Filament\Admin\Resources\BantuanPkhResource\Pages;

use App\Filament\Admin\Resources\BantuanPkhResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBantuanPkh extends EditRecord
{
    protected static string $resource = BantuanPkhResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
