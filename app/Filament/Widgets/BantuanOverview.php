<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Filament\Admin\Resources\BantuanBpntResource\Widgets\BantuanBpntOverview;
use App\Filament\Admin\Resources\BantuanPkhResource\Widgets\BantuanPkhOverview;
use App\Filament\Admin\Resources\BantuanPpksResource\Widgets\BantuanPpksOverview;
use App\Filament\Admin\Resources\BantuanRastraResource\Widgets\BantuanRastraOverview;
use App\Filament\Admin\Resources\RekapPenerimaBpjsResource\Widgets\RekapPenerimaBpjsOverview;
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
