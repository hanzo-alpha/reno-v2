<?php

namespace App\Filament\Clusters\ProgramPpks\Resources\PenyaluranBantuanPpksResource\Pages;

use App\Filament\Clusters\ProgramPpks\Resources\PenyaluranBantuanPpksResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePenyaluranBantuanPpks extends CreateRecord
{
    protected static string $resource = PenyaluranBantuanPpksResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Data Penyaluran PPKS berhasil disimpan';
    }
}
