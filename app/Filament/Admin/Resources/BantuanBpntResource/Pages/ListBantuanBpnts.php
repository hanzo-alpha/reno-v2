<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\BantuanBpntResource\Pages;

use App\Filament\Admin\Resources\BantuanBpntResource;
use App\Filament\Imports\BantuanBpntImporter;
use App\Models\BantuanBpnt;
use App\Traits\HasInputDateLimit;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Laravolt\Indonesia\Models\Village;

class ListBantuanBpnts extends ListRecords
{
    use HasInputDateLimit;

    protected static string $resource = BantuanBpntResource::class;

    public function getTabs(): array
    {
        if (null !== auth()->user()->instansi_code) {
            return [];
        }

        $results = collect();
        $bantuan = Village::query()->whereIn('district_code', config('custom.kode_kecamatan'))->get();
        $bantuan->each(function ($item) use (&$results): void {
            $results->put('semua', Tab::make()->badge(BantuanBpnt::query()->count()));
            $results->put(Str::lower($item->name), Tab::make()
                ->badge(BantuanBpnt::query()->whereHas(
                    'kel',
                    function (Builder $query) use ($item): void {
                        $query->where('bantuan_bpnt.kelurahan', $item->code);
                    },
                )->count())
                ->modifyQueryUsing(
                    fn(Builder $query) => $query->whereHas(
                        'kel',
                        fn(Builder $query) => $query->where('bantuan_bpnt.kelurahan', $item->code),
                    ),
                ));
        });

        return $results->toArray();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\ImportAction::make('upload')
                ->importer(BantuanBpntImporter::class)
                ->icon('heroicon-o-arrow-up-tray')
                ->color('success')
                ->label('Upload CSV')
                ->closeModalByClickingAway(false)
                ->disabled($this->enableInputLimitDate('bpnt')),
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus')
                ->disabled($this->enableInputLimitDate('bpnt')),
        ];
    }

    protected function paginateTableQuery(Builder $query): Paginator
    {
        return $query->fastPaginate($this->getTableRecordsPerPage());
    }
}
