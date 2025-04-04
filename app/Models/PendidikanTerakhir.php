<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class PendidikanTerakhir extends Model
{
    public $timestamps = false;

    protected $table = 'pendidikan_terakhir';

    protected $fillable = [
        'nama_pendidikan',
    ];
}
