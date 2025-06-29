<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LokasiBantuan extends Model
{
    use HasUuids;

    protected $table = 'lokasi_bantuan';

    protected $fillable = [
        'lokasi',
        'latitude',
        'longitude',
        'location',
        'bantuan_rastra_id',
        'lokasi_bantuan_uuid'
    ];

    public static function getLatLngAttributes(): array
    {
        return [
            'lat' => 'latitude',
            'lng' => 'longitude',
        ];
    }

//    protected $appends = ['location'];

    public static function getComputedLocation(): string
    {
        return 'location';
    }

    public function uniqueIds(): array
    {
        return ['lokasi_bantuan_uuid'];
    }

    public function getRouteKeyName(): string
    {
        return 'lokasi_bantuan_uuid';
    }

    public function bantuanRastra(): BelongsTo
    {
        return $this->belongsTo(BantuanRastra::class);
    }

    public function getLocationAttribute(): array
    {
        return [
            'lat' => (float) $this->latitude,
            'lng' => (float) $this->longitude,
        ];
    }

    public function setLocationAttribute(?array $location): void
    {
        if (is_array($location)) {
            $this->attributes['latitude'] = $location['lat'];
            $this->attributes['longitude'] = $location['lng'];
            unset($this->attributes['location']);
        }
    }

    protected function casts(): array
    {
        return [
            'lokasi_bantuan_uuid' => 'string',
        ];
    }


//    protected function location(): Attribute
//    {
//        return Attribute::make(
//            get: fn(mixed $value, array $attributes) => [
//                'lokasi' => $attributes['lokasi'],
//                'latitude' => $attributes['lat'],
//                'longitude' => $attributes['lng']
//            ],
//            set: fn(array $value) => [
//                'lokasi' => $value['lokasi'],
//                'latitude' => $value['lat'],
//                'longitude' => $value['lng']
//            ],
//        );
//    }
}
