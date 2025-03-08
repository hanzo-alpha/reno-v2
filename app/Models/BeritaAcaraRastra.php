<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasWilayah;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BeritaAcaraRastra extends Model
{
    use HasUuids;
    use HasWilayah;

    protected $table = 'berita_acara_rastra';

    protected $casts = [
        'tgl_ba' => 'date',
        'upload_ba' => 'array',
        'bantuan_rastra_ids' => 'array',
    ];

    protected $with = [
        'penandatangan', 'itemBantuan', 'kel', 'kec',
    ];

    public function uniqueIds(): array
    {
        return ['berita_acara_id'];
    }

    public function getRouteKeyName(): string
    {
        return 'berita_acara_uuid';
    }

    public function penandatangan(): BelongsTo
    {
        return $this->belongsTo(Penandatangan::class);
    }

    public function bantuanRastra(): HasMany
    {
        return $this->hasMany(BantuanRastra::class);
    }

    public function itemBantuan(): BelongsToMany
    {
        return $this->belongsToMany(ItemBantuan::class, 'item_bantuan_berita_acara_rastra')
            ->withTimestamps();
    }
}
