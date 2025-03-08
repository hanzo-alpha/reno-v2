<?php

namespace App\Filament\Pages;

use Illuminate\Contracts\Support\Htmlable;
use ShuvroRoy\FilamentSpatieLaravelBackup\Pages\Backups as BaseBackups;

class Backup extends BaseBackups
{
    protected static ?string $navigationIcon = null;
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationLabel = 'Backup Database';

    public static function getNavigationGroup(): ?string
    {
        return 'Managemen Pengguna';
    }

    public function getHeading(): string|Htmlable
    {
        return 'Backup Database';
    }
}
