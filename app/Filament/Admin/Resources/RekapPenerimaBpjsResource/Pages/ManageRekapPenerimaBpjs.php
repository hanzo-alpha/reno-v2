<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\RekapPenerimaBpjsResource\Pages;

use App\Filament\Admin\Resources\RekapPenerimaBpjsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRekapPenerimaBpjs extends ManageRecords
{
    protected static string $resource = RekapPenerimaBpjsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
