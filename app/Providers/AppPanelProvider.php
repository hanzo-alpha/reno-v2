<?php

namespace App\Providers;

use Awcodes\Curator\CuratorPlugin;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Saade\FilamentLaravelLog\FilamentLaravelLogPlugin;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('app')
            ->path('')
            ->topNavigation()
            ->topbar()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->plugins([
                BreezyCore::make()
                    ->avatarUploadComponent(fn($fileUpload) => $fileUpload->disableLabel())
                    ->enableTwoFactorAuthentication()
                    ->myProfile(
                        hasAvatars: true,
                        slug: 'profil-saya',
                        navigationGroup: 'Pengaturan',
                    ),
                CuratorPlugin::make()
                    ->label('Media')
                    ->pluralLabel('Media')
                    ->navigationIcon(fn() => null)
                    ->navigationGroup('Pengaturan')
                    ->navigationCountBadge()
                    ->defaultListView('grid'),
                FilamentLaravelLogPlugin::make()
                    ->authorize(fn(): bool => auth()->user()->is_admin)
//                    ->navigationGroup('Managemen Pengguna')
//                    ->navigationLabel('Logs')
//                    ->navigationIcon('heroicon-o-bug-ant')
//                    ->navigationSort(1)
                    ->slug('logs'),
            ])
            ->discoverResources(in: app_path('Filament/App/Resources'), for: 'App\\Filament\\App\\Resources')
            ->discoverPages(in: app_path('Filament/App/Pages'), for: 'App\\Filament\\App\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/App/Widgets'), for: 'App\\Filament\\App\\Widgets')
            ->widgets([
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->viteTheme('resources/css/app/theme.css')
            ->authMiddleware([
//                Authenticate::class,
            ]);
    }
}
