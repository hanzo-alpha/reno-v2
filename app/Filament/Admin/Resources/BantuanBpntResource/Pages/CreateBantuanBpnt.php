<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\BantuanBpntResource\Pages;

use App\Filament\Admin\Resources\BantuanBpntResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBantuanBpnt extends CreateRecord
{
    protected static string $resource = BantuanBpntResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['jenis_bantuan_id'] = 2;

        return $data;
    }
}
