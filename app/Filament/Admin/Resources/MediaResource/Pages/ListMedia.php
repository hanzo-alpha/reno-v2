<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\MediaResource\Pages;

use App\Filament\Admin\Resources\MediaResource;
use Awcodes\Curator\Resources\MediaResource\ListMedia as CuratorListMedia;

class ListMedia extends CuratorListMedia
{
    protected static string $resource = MediaResource::class;

    //    protected function getHeaderActions(): array
    //    {
    //        return [
    //            Actions\CreateAction::make(),
    //        ];
    //    }
}
