<?php

namespace App\Filament\Admin\Resources\ItemBantuanResource\Pages;

use App\Filament\Admin\Resources\ItemBantuanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageItemBantuans extends ManageRecords
{
    protected static string $resource = ItemBantuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
