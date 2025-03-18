<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\MediaResource\Pages;

use App\Filament\Admin\Resources\MediaResource;
use Awcodes\Curator\Resources\MediaResource\EditMedia as CuratorEditMedia;

class EditMedia extends CuratorEditMedia
{
    protected static string $resource = MediaResource::class;
}
