<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipePpks extends Model
{
    public $timestamps = false;

    protected $table = 'tipe_ppks';

    protected $with = ['kriteria_ppks'];

    public function kriteria_ppks(): BelongsToMany
    {
        return $this->belongsToMany(KriteriaPpks::class, 'tipe_ppks_kriteria_ppks');
    }

    public function kriteriaPpks(): HasMany
    {
        return $this->hasMany(KriteriaPpks::class);
    }

    public function bantuanPpks(): BelongsTo
    {
        return $this->belongsTo(BantuanPpks::class);
    }
}
