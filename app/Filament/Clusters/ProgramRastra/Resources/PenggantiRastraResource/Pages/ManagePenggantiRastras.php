<?php

declare(strict_types=1);

namespace App\Filament\Clusters\ProgramRastra\Resources\PenggantiRastraResource\Pages;

use App\Filament\Clusters\ProgramRastra\Resources\PenggantiRastraResource;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;

class ManagePenggantiRastras extends ManageRecords
{
    protected static string $resource = PenggantiRastraResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }

    protected function paginateTableQuery(Builder $query): Paginator
    {
        return $query->fastPaginate($this->getTableRecordsPerPage());
    }
}
