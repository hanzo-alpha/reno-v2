<?php

namespace App\Filament\Clusters\ProgramRastra\Resources\LokasiBantuanResource\Pages;

use App\Filament\Clusters\ProgramRastra\Resources\LokasiBantuanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLokasiBantuan extends ViewRecord
{
    protected static string $resource = LokasiBantuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
