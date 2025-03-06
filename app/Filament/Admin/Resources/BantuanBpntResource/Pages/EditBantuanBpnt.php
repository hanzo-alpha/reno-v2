<?php

namespace App\Filament\Admin\Resources\BantuanBpntResource\Pages;

use App\Filament\Admin\Resources\BantuanBpntResource;
use App\Traits\HasInputDateLimit;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBantuanBpnt extends EditRecord
{
    use HasInputDateLimit;

    protected static string $resource = BantuanBpntResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->disabled($this->enableInputLimitDate('bpnt')),
            Actions\DeleteAction::make()
                ->disabled($this->enableInputLimitDate('bpnt')),
        ];
    }
}
