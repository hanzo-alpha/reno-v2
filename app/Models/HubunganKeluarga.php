<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class HubunganKeluarga extends Model
{
    public $timestamps = false;

    protected $table = 'hubungan_keluarga';

    protected $fillable = [
        'nama_hubungan',
    ];
}
