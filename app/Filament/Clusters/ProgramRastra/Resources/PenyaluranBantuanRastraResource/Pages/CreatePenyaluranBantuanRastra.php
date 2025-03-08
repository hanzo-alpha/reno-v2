<?php

declare(strict_types=1);

namespace App\Filament\Clusters\ProgramRastra\Resources\PenyaluranBantuanRastraResource\Pages;

use App\Filament\Clusters\ProgramRastra\Resources\PenyaluranBantuanRastraResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePenyaluranBantuanRastra extends CreateRecord
{
    protected static string $resource = PenyaluranBantuanRastraResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Data Penyaluran Rastra berhasil disimpan';
    }
}
