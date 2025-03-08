<?php

declare(strict_types=1);

namespace App\Filament\Clusters\ProgramRastra\Resources\PenyaluranBantuanRastraResource\Pages;

use App\Filament\Clusters\ProgramRastra\Resources\PenyaluranBantuanRastraResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPenyaluranBantuanRastra extends ViewRecord
{
    protected static string $resource = PenyaluranBantuanRastraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
