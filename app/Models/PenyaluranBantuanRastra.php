<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\StatusPenyaluran;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class PenyaluranBantuanRastra extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $table = 'penyaluran_bantuan_rastra';

    protected $casts = [
        'tgl_penyerahan' => 'datetime',
        'foto_penyerahan' => 'array',
        'status_penyaluran' => StatusPenyaluran::class,
    ];

    protected $with = [
        'bantuan_rastra',
    ];

    protected $appends = [
        'location',
    ];

    public static function getLatLngAttributes(): array
    {
        return [
            'lat' => 'lat',
            'lng' => 'lng',
        ];
    }

    public static function getComputedLocation(): string
    {
        return 'location';
    }

    public function uniqueIds(): array
    {
        return ['penyaluran_bantuan_rastra_uuid'];
    }

    public function getRouteKeyName(): string
    {
        return 'penyaluran_bantuan_rastra_uuid';
    }

    public function penandatangan(): BelongsTo
    {
        return $this->belongsTo(Penandatangan::class);
    }

    public function bantuan_rastra(): BelongsTo
    {
        return $this->belongsTo(BantuanRastra::class);
    }

    public function beritaAcara(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
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
            unset($this->attributes['location']);
        }
    }

    protected static function booted(): void
    {
        static::deleted(static function (PenyaluranBantuanRastra $penyaluran): void {
            foreach ($penyaluran->foto_penyerahan as $image) {
                Storage::delete("app/public/{$image}");
            }
        });

        static::updating(static function (PenyaluranBantuanRastra $penyaluran): void {
            $imagesToDelete = array_diff($penyaluran->getOriginal('foto_penyerahan'), $penyaluran->foto_penyerahan);

            foreach ($imagesToDelete as $image) {
                Storage::delete("app/public/{$image}");
            }
        });
    }
}
