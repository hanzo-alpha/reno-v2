<?php

namespace App\Filament\Clusters\ProgramRastra\Resources\LokasiBantuanResource\Pages;

use App\Filament\Clusters\ProgramRastra\Resources\LokasiBantuanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLokasiBantuans extends ListRecords
{
    protected static string $resource = LokasiBantuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
