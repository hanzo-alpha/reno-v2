<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class BantuanRastraPerMonthChart extends ApexChartWidget
{
    use HasWidgetShield;

    /**
     * Chart Id
     */
    protected static ?string $chartId = 'bantuanRastraPerMonthChart';

    /**
     * Widget Title
     */
    protected static ?string $heading = 'Bantuan Rastra Per Bulan';

    protected static ?int $sort = 8;

    protected static bool $isDiscovered = false;

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     */
    protected function getOptions(): array
    {
        $listBulan = list_bulan(short: true);

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Bantuan Rastra Per Bulan',
                    'data' => [7, 4, 6, 10, 14, 7, 5, 9, 10, 15, 13, 18],
                ],
            ],
            'xaxis' => [
                'categories' => array_values($listBulan),
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#f59e0b'],
        ];
    }
}
