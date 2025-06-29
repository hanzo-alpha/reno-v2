<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\StatusAktif;
use App\Enums\StatusDtksEnum;
use App\Enums\StatusRastra;
use App\Enums\StatusVerifikasiEnum;
use App\Traits\HasTambahan;
use App\Traits\HasWilayah;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class BantuanRastra extends Model
{
    use HasTambahan;
    use HasUuids;
    use HasWilayah;
    use SoftDeletes;

    protected $table = 'bantuan_rastra';

    protected $guarded = [];

    protected $with = [
        'kec', 'kel', 'penggantiRastra',
    ];

    protected $appends = [
        'lokasi',
    ];

    protected $casts = [
        'dtks_id' => 'string',
        'foto_ktp_kk' => 'array',
        'pengganti_rastra' => 'array',
        'status_dtks' => StatusDtksEnum::class,
        'status_rastra' => StatusRastra::class,
        'status_aktif' => StatusAktif::class,
        'status_verifikasi' => StatusVerifikasiEnum::class,
        'keterangan' => 'string',
    ];

    public static function getComputedLocation(): string
    {
        return 'lokasi';
    }


    public static function getLatLngAttributes(): array
    {
        return [
            'lat' => 'latitude',
            'lng' => 'longitude',
        ];
    }

    public function getLocationAttribute(): array
    {
        return [
            'lat' => (float) $this->lat,
            'lng' => (float) $this->lng,
        ];
    }

    public function setLocationAttribute(?array $location): void
    {
        if (is_array($location)) {
            $this->attributes['lat'] = $location['lat'];
            $this->attributes['lng'] = $location['lng'];
            unset($this->attributes['lokasi']);
        }
    }

    public function uniqueIds(): array
    {
        return ['bantuan_rastra_uuid'];
    }

    public function getRouteKeyName(): string
    {
        return 'bantuan_rastra_uuid';
    }

    public function beritaAcara(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }

    public function penyaluran(): HasOne
    {
        return $this->hasOne(PenyaluranBantuanRastra::class);
    }

    public function attachments(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }

    public function penggantiRastra(): HasOne
    {
        return $this->hasOne(PenggantiRastra::class);
    }

    public function lokasiBantuan(): BelongsTo
    {
        return $this->belongsTo(LokasiBantuan::class, 'id', 'bantuan_rastra_id');
    }

    protected static function booted(): void
    {
        //        static::deleted(static function (BantuanRastra $bantuanRastra): void {
        //            foreach ($bantuanRastra->foto_ktp_kk as $image) {
        //                Storage::delete("public/{$image}");
        //            }
        //        });
        //
        //        static::updating(static function (BantuanRastra $bantuanRastra): void {
        //            $imagesToDelete = array_diff($bantuanRastra->getOriginal('foto_ktp_kk'), $bantuanRastra->foto_ktp_kk);
        //
        //            foreach ($imagesToDelete as $image) {
        //                Storage::delete("public/{$image}");
        //            }
        //        });
    }
}
