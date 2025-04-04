<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\BantuanBpntResource\Widgets;

use App\Models\BantuanBpnt;
use App\Traits\HasGlobalFilters;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;
use Laravolt\Indonesia\Models\District;
use Number;

class BantuanBpntOverview extends BaseWidget
{
    use HasGlobalFilters;
    use HasWidgetShield;
    use InteractsWithPageFilters;

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $filters = $this->getFilters();

        $results = [];

        $listKecamatan = District::query()
            ->where('city_code', setting('app.kodekab'))
            ->pluck('name', 'code');

        foreach ($listKecamatan as $code => $name) {
            $value = BantuanBpnt::query()
                ->select(['created_at', 'kecamatan', 'kelurahan'])
                ->when($filters['kecamatan'], fn(Builder $query) => $query->where('kecamatan', $filters))
                ->when($filters['kelurahan'], fn(Builder $query) => $query->where('kelurahan', $filters))
                ->where('kecamatan', $code)
                ->count();
            $label = 'KPM BPNT Kec. ' . $name;
            $desc = 'Total BPNT Kec. ' . $name;
            $icon = 'user';

            $results[] = $this->renderStats($value, $label, $desc, $icon);
        }

        $results['all'] = $this->renderStats(
            BantuanBpnt::count(),
            'Rekap KPM BPNT',
            'Total KPM Program BPNT Semua Kecamatan',
            'users',
            'primary',
        );

        return $results;
    }

    protected function renderStats($value, $label, $desc, $icon, $color = 'success')
    {
        return Stat::make(
            label: $label ?? 'KPM PKH Kec. Marioriwawo',
            value: Number::format($value ?? 0, 0, locale: 'id') . config('custom.app.stat_prefix'),
        )
            ->description($desc ?? 'Total KPM')
            ->descriptionIcon('heroicon-o-' . $icon ?? 'document-chart-bar')
            ->color($color ?? 'success');
    }
}
