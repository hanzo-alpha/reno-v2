<?php

declare(strict_types=1);

namespace App\Filament\Clusters\ProgramRastra\Resources\ItemBantuanResource\Pages;

use App\Filament\Clusters\ProgramRastra\Resources\ItemBantuanResource;
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
