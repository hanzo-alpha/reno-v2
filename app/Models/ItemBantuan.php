<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravolt\Indonesia\Models\Village;

class ItemBantuan extends Model
{
    protected $table = 'item_bantuan';

    protected $guarded = [];

    protected $with = ['kel'];

    public function beritaAcara(): BelongsToMany
    {
        return $this->belongsToMany(BeritaAcaraRastra::class, 'item_bantuan_berita_acara_rastra', 'item_bantuan_id',
            'berita_acara_rastra_id');
    }

    public function kel(): BelongsTo
    {
        return $this->belongsTo(Village::class, 'kode_kelurahan', 'code');
    }

    public function jenisBantuan(): BelongsTo
    {
        return $this->belongsTo(JenisBantuan::class);
    }
}
