<?php

namespace App\Filament\Admin\Resources\BantuanBpjsResource\Pages;

use App\Filament\Admin\Resources\BantuanBpjsResource;
use App\Traits\HasInputDateLimit;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBantuanBpjs extends EditRecord
{
    use HasInputDateLimit;

    protected static string $resource = BantuanBpjsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->disabled($this->enableInputLimitDate('bpjs')),
            Actions\DeleteAction::make()
                ->disabled($this->enableInputLimitDate('bpjs')),
        ];
    }
}
