<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\PenyaluranBantuanRastra;
use Cheesegrits\FilamentGoogleMaps\Filters\MapIsFilter;
use Cheesegrits\FilamentGoogleMaps\Widgets\MapTableWidget;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class PenyaluranBantuanRastraMap extends MapTableWidget
{
    protected static ?string $heading = 'Peta Penyaluran Bantuan Rastra';

    protected static ?int $sort = 1;

    protected static ?string $pollingInterval = null;

    protected static ?bool $clustering = true;

    protected static ?bool $fitToBounds = true;

    protected static ?int $zoom = 12;

    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return PenyaluranBantuanRastra::query()
            ->with(['bantuan_rastra', 'beritaAcara', 'penandatangan']);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('bantuan_rastra.nama_lengkap'),
            TextColumn::make('no_kk'),
            TextColumn::make('nik_kpm')
                ->searchable(),
            TextColumn::make('lokasi')
                ->searchable(),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            //            SelectFilter::make('state')
            //                ->label('State')
            //                ->relationship('state', 'state_name'),
            MapIsFilter::make('map'),
        ];
    }

    //    protected function getData(): array
    //    {
    //    	/**
    //    	 * You can use whatever query you want here, as long as it produces a set of records with your
    //    	 * lat and lng fields in them.
    //    	 */
    //        $locations = \App\Models\PenyaluranBantuanRastra::query()->limit(500)->get();
    //
    //        $data = [];
    //
    //        foreach ($locations as $location)
    //        {
    //			/**
    //			 * Each element in the returned data must be an array
    //			 * containing a 'location' array of 'lat' and 'lng',
    //			 * and a 'label' string (optional but recommended by Google
    //			 * for accessibility.
    //			 *
    //			 * You should also include an 'id' attribute for internal use by this plugin
    //			 */
    //            $data[] = [
    //                'location'  => [
    //                    'lat' => $location->lat ? round(floatval($location->lat), static::$precision) : 0,
    //                    'lng' => $location->lng ? round(floatval($location->lng), static::$precision) : 0,
    //                ],
    //
    //                'label'     => $location->lat . ',' . $location->lng,
    //
    //                'id' => $location->getKey(),
    //
    //				/**
    //				 * Optionally you can provide custom icons for the map markers,
    //				 * either as scalable SVG's, or PNG, which doesn't support scaling.
    //				 * If you don't provide icons, the map will use the standard Google marker pin.
    //				 */
    ////				'icon' => [
    ////					'url' => url('images/dealership.svg'),
    ////					'type' => 'svg',
    ////					'scale' => [35,35],
    ////				],
    //            ];
    //        }
    //
    //        return $data;
    //    }
}
