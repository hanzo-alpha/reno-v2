<?php

declare(strict_types=1);

namespace App\Models;

use Awcodes\Curator\Models\Media as CuratorMedia;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;

class Media extends CuratorMedia
{
    use MediaAlly;

    protected $table = 'media';
}
