<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Filament\Admin\Resources\BantuanBpntResource\Widgets\BantuanBpntOverview;
use App\Filament\Admin\Resources\BantuanPkhResource\Widgets\BantuanPkhOverview;
use App\Filament\Clusters\ProgramBpjs\Resources\RekapPenerimaBpjsResource\Widgets\RekapPenerimaBpjsOverview;
use App\Filament\Clusters\ProgramPpks\Resources\BantuanPpksResource\Widgets\BantuanPpksOverview;
use App\Filament\Clusters\ProgramRastra\Resources\BantuanRastraResource\Widgets\BantuanRastraOverview;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Kenepa\MultiWidget\MultiWidget;

class BantuanOverview extends MultiWidget
{
    use HasWidgetShield;
    use InteractsWithPageFilters;

    public array $widgets = [
//        BantuanBpjsOverview::class,
        RekapPenerimaBpjsOverview::class,
        BantuanRastraOverview::class,
        BantuanPkhOverview::class,
        BantuanBpntOverview::class,
        BantuanPpksOverview::class,
    ];
}
