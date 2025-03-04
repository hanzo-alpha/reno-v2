<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class JenisPekerjaan extends Model
{
    public $timestamps = false;

    protected $table = 'jenis_pekerjaan';

    protected $fillable = [
        'nama_pekerjaan',
    ];
}
