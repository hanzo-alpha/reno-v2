<?php

namespace App\Filament\Admin\Resources\BantuanBpjsResource\Pages;

use App\Filament\Admin\Resources\BantuanBpjsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBantuanBpjs extends EditRecord
{
    protected static string $resource = BantuanBpjsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
