<?php

declare(strict_types=1);

namespace App\Filament\Clusters\ProgramPpks\Resources\BantuanPpksResource\Pages;

use App\Filament\Clusters\ProgramPpks\Resources\BantuanPpksResource;
use App\Models\BantuanPpks;
use App\Traits\HasInputDateLimit;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBantuanPpks extends ViewRecord
{
    use HasInputDateLimit;

    protected static string $resource = BantuanPpksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('cetak ba')
                ->label('Cetak Berita Acara')
                ->color('success')
                ->icon('heroicon-o-printer')
                ->disabled($this->enableInputLimitDate('ppks'))
                ->url(fn($record) => route('ba.ppks', ['id' => $record, 'm' => BantuanPpks::class]), true),
            Actions\EditAction::make()
                ->icon('heroicon-o-pencil-square')
                ->disabled($this->enableInputLimitDate('ppks')),
        ];
    }
}
