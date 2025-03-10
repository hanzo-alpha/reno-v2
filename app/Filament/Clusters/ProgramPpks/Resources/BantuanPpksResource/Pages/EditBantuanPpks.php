<?php

declare(strict_types=1);

namespace App\Filament\Clusters\ProgramPpks\Resources\BantuanPpksResource\Pages;

use App\Filament\Clusters\ProgramPpks\Resources\BantuanPpksResource;
use App\Traits\HasInputDateLimit;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBantuanPpks extends EditRecord
{
    use HasInputDateLimit;

    protected static string $resource = BantuanPpksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->icon('heroicon-o-eye'),
            Actions\DeleteAction::make()
                ->icon('heroicon-o-trash'),
            Actions\ForceDeleteAction::make()
                ->icon('heroicon-o-trash'),
            Actions\RestoreAction::make()
                ->icon('heroicon-o-arrow-uturn-left'),
        ];
    }
}
