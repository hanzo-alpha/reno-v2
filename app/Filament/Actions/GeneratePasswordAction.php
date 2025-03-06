<?php

declare(strict_types=1);

namespace App\Filament\Actions;

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;

class GeneratePasswordAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-s-key')
            ->color('info')
            ->action(function (Set $set): void {
                $password = Str::password();

                $set('password', $password);
                $set('passwordConfirmation', $password);

                Notification::make()
                    ->success()
                    ->title(__('Password successfully generated.'))
                    ->send();
            });
    }
    public static function getDefaultName(): ?string
    {
        return 'generatePassword';
    }
}
