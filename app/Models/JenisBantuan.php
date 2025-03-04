<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class JenisBantuan extends Model
{
    public $timestamps = false;

    protected $table = 'jenis_bantuan';

    protected $fillable = [
        'nama_bantuan',
        'alias',
        'warna',
        'model_name',
        'deskripsi',
    ];
}
