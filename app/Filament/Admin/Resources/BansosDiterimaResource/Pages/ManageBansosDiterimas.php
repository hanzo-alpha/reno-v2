<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\BansosDiterimaResource\Pages;

use App\Filament\Admin\Resources\BansosDiterimaResource;
use App\Traits\HasInputDateLimit;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBansosDiterimas extends ManageRecords
{
    use HasInputDateLimit;

    protected static string $resource = BansosDiterimaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus')
                ->disabled($this->enableInputLimitDate('ppks')),
        ];
    }
}
