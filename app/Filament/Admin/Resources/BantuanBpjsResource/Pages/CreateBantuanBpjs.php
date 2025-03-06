<?php

namespace App\Filament\Admin\Resources\BantuanBpjsResource\Pages;

use App\Filament\Admin\Resources\BantuanBpjsResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateBantuanBpjs extends CreateRecord
{
    protected static string $resource = BantuanBpjsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['dtks_id'] ??= Str::uuid()->toString();
        $data['bulan'] ??= now()->month;
        $data['tahun'] ??= now()->year;
        $data['jenis_bantuan_id'] = 1;

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Data Bantuan BPJS berhasil disimpan';
    }
}
