<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\BantuanRastraResource\Pages;

use App\Exports\ExportBantuanRastra;
use App\Filament\Admin\Resources\BantuanRastraResource;
use App\Filament\Imports\BantuanRastraImporter;
use App\Models\BantuanRastra;
use App\Traits\HasInputDateLimit;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Laravolt\Indonesia\Models\Village;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

class ListBantuanRastras extends ListRecords
{
    use HasInputDateLimit;

    protected static string $resource = BantuanRastraResource::class;

    public function getTabs(): array
    {
        if (null !== auth()->user()->instansi_code) {
            return [];
        }

        $results = collect();
        $bantuan = Village::query()->whereIn('district_code', config('custom.kode_kecamatan'))->get();
        $bantuan->each(function ($item, $key) use (&$results): void {
            $results->put('semua', Tab::make()->badge(BantuanRastra::query()->count()));
            $results->put(Str::lower($item->name), Tab::make()
                ->badge(BantuanRastra::query()->whereHas(
                    'kel',
                    fn(Builder $query) => $query->where('bantuan_rastra.kelurahan', $item->code),
                )->count())
                ->modifyQueryUsing(
                    fn(Builder $query) => $query->whereHas(
                        'kel',
                        fn(Builder $query) => $query->where('bantuan_rastra.kelurahan', $item->code),
                    ),
                ));
        });

        return $results->toArray();
    }

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->label('Download XLS')
                ->color('success')
                ->exports([
                    ExportBantuanRastra::make(),
                ])
                ->disabled($this->enableInputLimitDate('rastra')),

            Actions\ImportAction::make()
                ->label('Upload CSV')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('warning')
                ->authorize('upload')
                ->importer(BantuanRastraImporter::class)
                ->options([
                    'updateExisting' => true,
                ])
                ->maxRows(5000)
                ->chunkSize(100)
                ->disabled($this->enableInputLimitDate('rastra')),

            Actions\CreateAction::make()
                ->icon('heroicon-o-plus')
                ->disabled($this->enableInputLimitDate('rastra')),
        ];
    }

    protected function paginateTableQuery(Builder $query): Paginator
    {
        return $query->fastPaginate($this->getTableRecordsPerPage());
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->with(['beritaAcara', 'attachments']);
    }
}
