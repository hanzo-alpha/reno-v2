<?php

namespace App\Filament\Admin\Resources\BantuanPpksResource\Pages;

use App\Filament\Admin\Resources\BantuanPpksResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBantuanPpks extends EditRecord
{
    protected static string $resource = BantuanPpksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
