<?php

namespace App\Providers;

use App\Filament\Admin\Resources\BansosDiterimaResource;
use App\Filament\Admin\Resources\HubunganKeluargaResource;
use App\Filament\Admin\Resources\JenisPekerjaanResource;
use App\Filament\Admin\Resources\KriteriaPpksResource;
use App\Filament\Admin\Resources\PenandatanganResource;
use App\Filament\Admin\Resources\PendidikanTerakhirResource;
use App\Filament\Admin\Resources\TipePpksResource;
use App\Filament\Admin\Resources\UserResource;
use App\Filament\Pages\Auth\Login;
use App\Filament\Pages\Settings\Administrasi;
use App\Filament\Pages\Settings\Laporan;
use App\Filament\Pages\Settings\Settings;
use Awcodes\Curator\CuratorPlugin;
use Awcodes\Curator\Resources\MediaResource;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use BezhanSalleh\FilamentShield\Resources\RoleResource;
use CharrafiMed\GlobalSearchModal\GlobalSearchModalPlugin;
use Filafly\PhosphorIconReplacement;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Support\Enums\Platform;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Outerweb\FilamentSettings\Filament\Plugins\FilamentSettingsPlugin;
use Rmsramos\Activitylog\ActivitylogPlugin;
use Rmsramos\Activitylog\Resources\ActivitylogResource;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->databaseTransactions()
            ->databaseNotifications()
            ->passwordReset()
            ->sidebarCollapsibleOnDesktop()
            ->spa()
            ->maxContentWidth(MaxWidth::Full)
            ->colors([
                'danger' => Color::Rose,
                'gray' => Color::Gray,
                'info' => Color::Sky,
                'primary' => Color::Blue,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
                'secondary' => Color::Indigo,
            ])
            ->favicon(asset('images/fresh/reno-dinsos-icon-only.png'))
            ->brandName(config('custom.app.name'))
            ->brandLogo(asset('images/fresh/reno-dinsos-high-resolution-logo-transparent.png'))
            ->brandLogoHeight(config('custom.app.logo_height'))
            ->darkModeBrandLogo(asset('images/fresh/reno-dinsos-high-resolution-logo-white-transparent.png'))
            ->font(config('custom.app.font', 'Inter'))
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->colors([
                'primary' => Color::Blue,
            ])
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->globalSearchFieldKeyBindingSuffix()
            ->globalSearchFieldSuffix(fn(): ?string => match (Platform::detect()) {
                Platform::Windows => 'CTRL+K',
                Platform::Linux,
                Platform::Mac => '⌘K',
                default => null,
            })
            ->navigation(function (NavigationBuilder $navigationBuilder): NavigationBuilder {
                return $navigationBuilder
                    ->items([
                        ...Pages\Dashboard::getNavigationItems(),
                    ])
                    ->groups([
                        NavigationGroup::make()
                            ->label('Bantuan Sosial')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->items([

                            ]),
                        NavigationGroup::make('Master Data')
                            ->label('Master Data')
                            ->icon('heroicon-o-circle-stack')
                            ->items([
                                ...BansosDiterimaResource::getNavigationItems(),
                                ...HubunganKeluargaResource::getNavigationItems(),
                                ...JenisPekerjaanResource::getNavigationItems(),
                                ...PenandatanganResource::getNavigationItems(),
                                ...PendidikanTerakhirResource::getNavigationItems(),
                                ...TipePpksResource::getNavigationItems(),
                                ...KriteriaPpksResource::getNavigationItems(),

                            ]),
                        NavigationGroup::make()
                            ->label('Pengaturan')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->items([
                                ...Settings::getNavigationItems(),
                                ...Administrasi::getNavigationItems(),
                                ...Laporan::getNavigationItems(),
                            ]),
                        NavigationGroup::make()
                            ->label('Managemen')
                            ->icon('heroicon-o-squares-2x2')
                            ->items([
                                ...UserResource::getNavigationItems(),
                                ...RoleResource::getNavigationItems(),
                                ...ActivitylogResource::getNavigationItems(),
                                ...MediaResource::getNavigationItems(),
                            ]),
                    ]);
            })
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->plugins([
                BreezyCore::make()
                    ->avatarUploadComponent(fn($fileUpload) => $fileUpload->disableLabel())
                    ->enableTwoFactorAuthentication()
                    ->myProfile(
                        hasAvatars: true,
                        slug: 'profil-saya',
                        navigationGroup: 'Pengaturan'
                    ),
                FilamentShieldPlugin::make(),
                CuratorPlugin::make()
                    ->label('Media')
                    ->pluralLabel('Media')
                    ->navigationIcon('heroicon-o-photo')
                    ->navigationGroup('Pengaturan')
                    ->navigationCountBadge()
                    ->defaultListView('grid'),
                PhosphorIconReplacement::make(),
                GlobalSearchModalPlugin::make()
                    ->closeByEscaping(false)
                    ->localStorageMaxItemsAllowed(20)
                    ->associateItemsWithTheirGroups(),
                FilamentSettingsPlugin::make()
                    ->pages([
                        Settings::class,
                        Administrasi::class,
                        Laporan::class,
                    ]),
                ActivityLogPlugin::make()
                    ->label('Aktivitas')
                    ->pluralLabel('Aktivitas')
                    ->navigationGroup('Pengaturan')
                    ->navigationItem(true)
                    ->navigationIcon('heroicon-o-shield-check')
                    ->navigationCountBadge(true),
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
            ->authMiddleware([
                Authenticate::class,
            ], isPersistent: true);
    }
}
