<?php

declare(strict_types=1);

namespace App\Filament\Actions\GlobalSearch;

use Filament\GlobalSearch\Actions\Action;

class TestAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        // TODO: Add your setup logic here
    }
    public static function getDefaultName(): ?string
    {
        return 'test';
    }
}
