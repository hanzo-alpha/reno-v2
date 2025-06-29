<?php

namespace App\Filament\Clusters\ProgramRastra\Resources\LokasiBantuanResource\Pages;

use App\Filament\Clusters\ProgramRastra\Resources\LokasiBantuanResource;
use Cheesegrits\FilamentGoogleMaps\Concerns\InteractsWithMaps;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLokasiBantuan extends EditRecord
{
    use InteractsWithMaps;

    protected static string $resource = LokasiBantuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
