<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\PenggantiRastraResource\Pages;

use App\Filament\Admin\Resources\PenggantiRastraResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePenggantiRastras extends ManageRecords
{
    protected static string $resource = PenggantiRastraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
