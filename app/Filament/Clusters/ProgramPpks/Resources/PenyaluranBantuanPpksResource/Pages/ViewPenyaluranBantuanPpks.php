<?php

declare(strict_types=1);

namespace App\Filament\Clusters\ProgramPpks\Resources\PenyaluranBantuanPpksResource\Pages;

use App\Filament\Clusters\ProgramPpks\Resources\PenyaluranBantuanPpksResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPenyaluranBantuanPpks extends ViewRecord
{
    protected static string $resource = PenyaluranBantuanPpksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
