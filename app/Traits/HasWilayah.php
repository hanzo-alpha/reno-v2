<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;

trait HasWilayah
{
    public function prov(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'provinsi', 'code');
    }

    public function kab(): BelongsTo
    {
        return $this->belongsTo(City::class, 'kabupaten', 'code');
    }

    public function kec(): BelongsTo
    {
        return $this->belongsTo(District::class, 'kecamatan', 'code');
    }

    public function kel(): BelongsTo
    {
        return $this->belongsTo(Village::class, 'kelurahan', 'code');
    }
}
