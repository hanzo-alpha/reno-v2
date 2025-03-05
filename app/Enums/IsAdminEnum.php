<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum IsAdminEnum: int implements HasColor, HasIcon, HasLabel
{
    case ADMIN = 1;
    case NOT_ADMIN = 0;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::NOT_ADMIN => 'Bukan Admin',
            self::ADMIN => 'Admin',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::NOT_ADMIN => 'primary',
            self::ADMIN => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::NOT_ADMIN => 'heroicon-o-lock-closed',
            self::ADMIN => 'heroicon-o-lock-open',
        };
    }
}
