<?php

namespace App\Filament\Clusters\ProgramRastra\Resources\BeritaAcaraRastraResource\Pages;

use App\Filament\Clusters\ProgramRastra\Resources\BeritaAcaraRastraResource;
use App\Models\BantuanRastra;
use App\Models\BeritaAcara;
use App\Models\BeritaAcaraRastra;
use App\Models\Kecamatan;
use App\Traits\HasInputDateLimit;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravolt\Indonesia\Models\District;

class ManageBeritaAcaraRastras extends ManageRecords
{
    use HasInputDateLimit;

    protected static string $resource = BeritaAcaraRastraResource::class;

    public function getTabs(): array
    {
        $results = collect();
        if (auth()->user()->hasRole(['super_admin', 'admin_rastra', 'admin'])) {
            $bantuan = District::query()->where('city_code', setting('app.kodekab'))->get();
            $bantuan->each(function ($item, $key) use (&$results): void {
                $results->put('semua', Tab::make()->badge(BeritaAcaraRastra::query()->count()));
                $results->put(Str::lower($item->name), Tab::make()
                    ->badge(BeritaAcaraRastra::query()->whereHas(
                        'kec',
                        fn(Builder $query) => $query->where('berita_acara_rastra.kecamatan', $item->code),
                    )->count())
                    ->modifyQueryUsing(
                        fn(Builder $query) => $query->whereHas(
                            'kec',
                            fn(Builder $query) => $query->where('berita_acara_rastra.kecamatan', $item->code),
                        ),
                    ));
            });

            return $results->toArray();
        }

        return $results->toArray();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus')
                ->using(function (array $data, string $model): Model {
                    $bantuan = BantuanRastra::query()
                        ->where('kecamatan', $data['kecamatan'])
                        ->where('kelurahan', $data['kelurahan'])
                        ->get();

                    $data['bantuan_rastra_ids'] = $bantuan->pluck('id');
                    return $model::create($data);
                })
                ->closeModalByClickingAway(false)
                ->disabled($this->enableInputLimitDate('rastra')),
        ];
    }
}
