<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\BantuanBpnt;
use App\Models\BantuanPkh;
use App\Models\BantuanPpks;
use App\Models\BantuanRastra;
use App\Models\JenisBantuan;
use App\Models\RekapPenerimaBpjs;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use JetBrains\PhpStorm\NoReturn;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class BantuanSosialPerKelurahanChart extends ApexChartWidget
{
    use HasWidgetShield;

    protected static bool $isDiscovered = true;

    protected static ?string $chartId = 'bantuanSosialPerKelurahanChart';

    protected static ?string $heading = 'Bantuan Sosial Per Kelurahan Chart';

    protected static bool $deferLoading = true;

    protected static ?string $pollingInterval = '30s';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected function getFormSchema(): array
    {
        return [
            Select::make('program')
                ->options(JenisBantuan::query()->pluck('alias', 'id'))
                ->default(3)
                ->native(false),
            Select::make('kecamatan')
                ->options(fn() => District::query()
                    ->where('city_code', setting('app.kodekab'))
                    ->pluck('name', 'code'))
                ->live()
                ->native(false),
            Select::make('kelurahan')
                ->options(fn(Get $get) => Village::query()
                    ->where('district_code', $get('kecamatan'))
                    ->pluck('name', 'code'))
                ->native(false),
            ToggleButtons::make('cTipe')
                ->default('bar')
                ->options([
                    'line' => 'Line',
                    'bar' => 'Bar',
                ])
                ->inline()
                ->grouped()
                ->label('Tipe Chart'),
            ToggleButtons::make('cStack')
                ->default(false)
                ->options([
                    true => 'Stack',
                    false => 'Normal',
                ])
                ->grouped()
                ->colors([
                    true => 'success',
                    false => 'danger',
                ])
                ->inline()
                ->label('Layout'),
            Toggle::make('chartGrid')
                ->default(false)
                ->label('Tampilkan Grid'),
            Toggle::make('cLabel')
                ->default(false)
                ->label('Tampilkan Label'),
        ];
    }

    protected function queryChart(string | int $model, $kodekel, array $filters): int | string | array | Builder | Collection
    {
        $model = match ((int) $model) {
            1 => BantuanPkh::class,
            2 => BantuanBpnt::class,
            3 => RekapPenerimaBpjs::class,
            4 => BantuanPpks::class,
            5 => BantuanRastra::class,
        };

        $query = $model::query()
            ->select(['created_at', 'kecamatan', 'kelurahan', 'jenis_bantuan_id'])
            ->when($filters['kecamatan'], fn(Builder $query) => $query->where('kecamatan', $filters['kecamatan']))
            ->when($filters['kelurahan'], fn(Builder $query) => $query->where('kelurahan', $filters['kelurahan']))
            ->where('kelurahan', $kodekel);

        if (RekapPenerimaBpjs::class === $model) {
            return $query->clone()->sum('jumlah');
        }

        return $query
            ->when($filters['program'], fn(Builder $query) => $query->where('jenis_bantuan_id', $filters['program']))
            ->count();
    }

    protected function queryChartArray(array | \Illuminate\Support\Collection $bantuan, $kodekel, array $filters): array
    {
        $results = [];

        foreach ($bantuan as $key => $item) {
            $model = match ((int) $item) {
                1 => BantuanPkh::class,
                2 => BantuanBpnt::class,
                3 => RekapPenerimaBpjs::class,
                4 => BantuanPpks::class,
                5 => BantuanRastra::class,
            };

            $results[] = $model::query()
                ->select(['created_at', 'kecamatan', 'kelurahan', 'jenis_bantuan_id'])
                ->when($filters['kecamatan'], fn(Builder $query) => $query->where('kecamatan', $filters['kecamatan']))
                ->when($filters['kelurahan'], fn(Builder $query) => $query->where('kelurahan', $filters['kelurahan']))
                ->when(
                    $filters['program'],
                    fn(Builder $query) => $query->where('jenis_bantuan_id', $filters['program']),
                )
                ->where('kelurahan', $kodekel)
                ->count();
        }

        return $results;
    }

    #[NoReturn]
    protected function getOptions(): array
    {
        $filters = $this->filterFormData;
        $results = [];
        $colors = ['#03A9F4', '#f59e0b', '#FDD835', '#BA68C8', '#66BB6A'];
        $gradientColors = ['#79cdf2', '#fbbf24', '#ffeb9b', '#c197c9', '#96e098'];

        $kel = Village::query()
            ->when(auth()->user()->instansi_code, function (Builder $query): void {
                $query->where('code', auth()->user()->instansi_code);
            })
            ->when($filters['kecamatan'], function (Builder $query) use ($filters): void {
                $query->where('kecamatan_code', $filters['kecamatan']);
            })
            ->when($filters['kelurahan'], function (Builder $query) use ($filters): void {
                $query->where('code', $filters['kelurahan']);
            })
            ->whereIn('district_code', config('custom.kode_kecamatan'))
            ->pluck('name', 'code');

        $jenisBantuan = JenisBantuan::find($filters['program']) ?? JenisBantuan::pluck('id', 'alias');

        foreach ($kel as $code => $name) {
            $results['labels'][$code] = $name;
            $results[$jenisBantuan->id][$name] = $this->queryChart($jenisBantuan->id, $code, $filters);
        }

        $cTipe = auth()->user()->instansi_code ? 'bar' : $filters['cTipe'];
        $cTipeOpt = (bool) auth()->user()->instansi_code;

        return [
            'chart' => [
                'type' => $cTipe,
                'height' => 480,
                'toolbar' => [
                    'show' => true,
                ],
            ],
            'series' => [
                [
                    'name' => $jenisBantuan->alias,
                    'data' => array_values($results[$jenisBantuan->id]),
                ],
            ],
            'plotOptions' => [
                'bar' => [
                    'distributed' => (bool) $filters['cStack'],
                    'stacked' => (bool) $filters['cStack'],
                    'horizontal' => $cTipeOpt,
                    'borderRadius' => 2,
                    'track' => [
                        'background' => 'transparent',
                        'strokeWidth' => '100%',
                    ],
                ],
            ],
            'xaxis' => [
                'categories' => array_values($results['labels']),
                'labels' => [
                    'style' => [
                        'fontWeight' => 500,
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontWeight' => 500,
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'fill' => [
                'type' => 'gradient',
                'gradient' => [
                    'shade' => 'dark',
                    'type' => 'vertical',
                    'shadeIntensity' => 0.5,
                    'gradientToColors' => $gradientColors,
                    'inverseColors' => true,
                    'opacityFrom' => 1,
                    'opacityTo' => 1,
                    'stops' => [0, 100],
                ],
            ],
            'dataLabels' => [
                'enabled' => (bool) $filters['cLabel'],
                'distributed' => (bool) $filters['cLabel'],
            ],
            'grid' => [
                'show' => $filters['chartGrid'],
            ],
            'tooltip' => [
                'enabled' => true,
            ],
            'colors' => $colors,
        ];
    }
}
