<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\AlasanEnum;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenggantiRastra extends Model
{
    use HasUuids;

    protected $table = 'pengganti_rastra';

    protected $guarded = [];

    protected $with = ['beritaAcara'];

    protected $casts = [
        'alasan_dikeluarkan' => AlasanEnum::class,
        'attachment' => 'array',
    ];

    public function uniqueIds(): array
    {
        return ['pengganti_rastra_uuid'];
    }

    public function getRouteKeyName(): string
    {
        return 'pengganti_rastra_uuid';
    }

    public function keluarga(): BelongsTo
    {
        return $this->belongsTo(BantuanRastra::class);
    }

    public function beritaAcara(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }

    public function bantuan_rastra(): BelongsTo
    {
        return $this->belongsTo(BantuanRastra::class);
    }
}
