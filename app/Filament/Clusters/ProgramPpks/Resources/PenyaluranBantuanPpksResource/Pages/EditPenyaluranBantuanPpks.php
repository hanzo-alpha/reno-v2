<?php

declare(strict_types=1);

namespace App\Filament\Clusters\ProgramPpks\Resources\PenyaluranBantuanPpksResource\Pages;

use App\Filament\Clusters\ProgramPpks\Resources\PenyaluranBantuanPpksResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenyaluranBantuanPpks extends EditRecord
{
    protected static string $resource = PenyaluranBantuanPpksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->icon('heroicon-m-magnifying-glass'),
            Actions\DeleteAction::make()
                ->icon('heroicon-m-trash'),
        ];
    }
}
