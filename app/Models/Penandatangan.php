<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\JabatanEnum;
use App\Enums\StatusPenandatangan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Teguh02\IndonesiaTerritoryForms\Models\District;
use Teguh02\IndonesiaTerritoryForms\Models\SubDistrict;

class Penandatangan extends Model
{
    protected $table = 'penandatangan';

    protected $with = ['kecamatan', 'kelurahan'];

    protected $casts = [
        'status_penandatangan' => StatusPenandatangan::class,
        'jabatan' => JabatanEnum::class,
    ];

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(District::class, 'kode_kecamatan', 'id');
    }

    public function kelurahan(): BelongsTo
    {
        return $this->belongsTo(SubDistrict::class, 'kode_instansi', 'id');
    }
}
