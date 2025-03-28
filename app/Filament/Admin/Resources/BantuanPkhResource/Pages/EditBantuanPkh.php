<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\BantuanPkhResource\Pages;

use App\Filament\Admin\Resources\BantuanPkhResource;
use App\Traits\HasInputDateLimit;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBantuanPkh extends EditRecord
{
    use HasInputDateLimit;

    protected static string $resource = BantuanPkhResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->disabled($this->enableInputLimitDate('pkh')),
            Actions\DeleteAction::make()
                ->disabled($this->enableInputLimitDate('pkh')),
        ];
    }
}
