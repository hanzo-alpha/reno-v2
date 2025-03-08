<?php

declare(strict_types=1);

namespace App\Filament\Clusters\ProgramRastra\Resources\PenyaluranBantuanRastraResource\Pages;

use App\Filament\Clusters\ProgramRastra\Resources\PenyaluranBantuanRastraResource;
use App\Traits\HasInputDateLimit;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;

class ListPenyaluranBantuanRastras extends ListRecords
{
    use HasInputDateLimit;

    protected static string $resource = PenyaluranBantuanRastraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus')
                ->disabled($this->enableInputLimitDate('rastra')),
        ];
    }

    protected function paginateTableQuery(Builder $query): Paginator
    {
        return $query->fastPaginate($this->getTableRecordsPerPage());
    }
}
