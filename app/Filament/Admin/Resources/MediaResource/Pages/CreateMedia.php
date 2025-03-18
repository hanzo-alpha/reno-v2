<?php

namespace App\Filament\Admin\Resources\MediaResource\Pages;

use App\Filament\Admin\Resources\MediaResource;
use Awcodes\Curator\Resources\MediaResource\CreateMedia as CuratorCreateMedia;

class CreateMedia extends CuratorCreateMedia
{
    protected static string $resource = MediaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (blank($data['title'])) {
            $data['title'] = pathinfo($data['originalFilename'], PATHINFO_FILENAME);
        }

        $file = $this->getFormComponentFileAttachmentUrl('file');

        $uploadedFileUrl = cloudinary()->upload($file)->getSecurePath();

        dd($uploadedFileUrl);

        unset($data['originalFilename']);

        return $data;
    }
}
