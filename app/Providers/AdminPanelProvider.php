<?php

declare(strict_types=1);

namespace App\Providers;

use App\Filament\Admin\Resources\BansosDiterimaResource;
use App\Filament\Admin\Resources\BantuanBpntResource;
use App\Filament\Admin\Resources\BantuanPkhResource;
use App\Filament\Admin\Resources\HubunganKeluargaResource;
use App\Filament\Admin\Resources\JenisPekerjaanResource;
use App\Filament\Admin\Resources\KriteriaPpksResource;
use App\Filament\Admin\Resources\MediaResource;
use App\Filament\Admin\Resources\PenandatanganResource;
use App\Filament\Admin\Resources\PendidikanTerakhirResource;
use App\Filament\Admin\Resources\RoleResource;
use App\Filament\Admin\Resources\TipePpksResource;
use App\Filament\Admin\Resources\UserResource;
use App\Filament\Clusters\ProgramBpjs;
use App\Filament\Clusters\ProgramPpks;
use App\Filament\Clusters\ProgramRastra;
use App\Filament\Pages\Auth\Login;
use App\Filament\Pages\Backup;
use App\Filament\Pages\Settings\Administrasi;
use App\Filament\Pages\Settings\Laporan;
use App\Filament\Pages\Settings\Settings;
use App\Filament\Reports\BeritaAcara;
use Awcodes\Curator\CuratorPlugin;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use CharrafiMed\GlobalSearchModal\GlobalSearchModalPlugin;
use Croustibat\FilamentJobsMonitor\FilamentJobsMonitorPlugin;
use Croustibat\FilamentJobsMonitor\Resources\QueueMonitorResource;
use Devonab\FilamentEasyFooter\EasyFooterPlugin;
use DiogoGPinto\AuthUIEnhancer\AuthUIEnhancerPlugin;
use EightyNine\Reports\ReportsPlugin;
use Filafly\Icons\Phosphor\PhosphorIcons;
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
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;
use Outerweb\FilamentSettings\Filament\Plugins\FilamentSettingsPlugin;
use Rmsramos\Activitylog\ActivitylogPlugin;
use Rmsramos\Activitylog\Resources\ActivitylogResource;
use Saade\FilamentLaravelLog\FilamentLaravelLogPlugin;
use Saade\FilamentLaravelLog\Pages\ViewLog;
use ShuvroRoy\FilamentSpatieLaravelBackup\FilamentSpatieLaravelBackupPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->databaseTransactions()
            ->databaseNotifications()
            ->passwordReset()
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
            ->navigation(fn(NavigationBuilder $navigationBuilder): NavigationBuilder => $navigationBuilder
                ->items([
                    ...Pages\Dashboard::getNavigationItems(),
                ])
                ->groups([
                    NavigationGroup::make('Manajemen Bantuan')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->items([
                            ...ProgramBpjs::getNavigationItems(),
                            ...BantuanPkhResource::getNavigationItems(),
                            ...BantuanBpntResource::getNavigationItems(),
                            ...ProgramRastra::getNavigationItems(),
                            ...ProgramPpks::getNavigationItems(),
                        ]),
                    NavigationGroup::make('Laporan')
                        ->icon('heroicon-o-document-text')
                        ->items([
                            ...BeritaAcara::getNavigationItems(),
                        ]),
                    NavigationGroup::make('Master Data')
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
                    NavigationGroup::make('Pengaturan')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->items([
                            ...Settings::getNavigationItems(),
                            ...Administrasi::getNavigationItems(),
                            ...Laporan::getNavigationItems(),
                        ]),
                    NavigationGroup::make('Managemen Pengguna')
                        ->icon('heroicon-o-squares-2x2')
                        ->items([
                            ...UserResource::getNavigationItems(),
                            ...RoleResource::getNavigationItems(),
                            ...ActivitylogResource::getNavigationItems(),
                            ...MediaResource::getNavigationItems(),
                            ...QueueMonitorResource::getNavigationItems(),
                            ...Backup::getNavigationItems(),
                            ...ViewLog::getNavigationItems(),
                        ]),
                ]))
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
                        navigationGroup: 'Pengaturan',
                    ),
                FilamentShieldPlugin::make(),
                CuratorPlugin::make()
                    ->label('Media')
                    ->pluralLabel('Media')
                    ->navigationIcon(fn() => null)
                    ->navigationGroup('Pengaturan')
                    ->navigationCountBadge()
                    ->resource(MediaResource::class)
                    ->defaultListView('grid'),
                PhosphorIcons::make(),
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
                FilamentJobsMonitorPlugin::make()
                    ->navigationGroup('Managemen Pengguna'),
                ReportsPlugin::make(),
                ActivityLogPlugin::make()
                    ->label('Aktivitas')
                    ->pluralLabel('Aktivitas')
                    ->navigationGroup('Pengaturan')
                    ->navigationItem(true)
                    ->navigationIcon('')
                    ->navigationCountBadge(true),
                EasyFooterPlugin::make()
                    ->withSentence(new HtmlString('<img src="/images/fresh/reno-dinsos-icon-only.png" style="margin-right:.5rem;" alt="Laravel Logo" width="20" height="20"> RENO DINSOS Kabupaten Soppeng'))
                    ->withLoadTime('Halaman ini dimuat dalam '),
                FilamentApexChartsPlugin::make(),
                FilamentSpatieLaravelBackupPlugin::make()
                    ->usingPolingInterval('10s')
                    ->usingPage(Backup::class),
                FilamentLaravelLogPlugin::make()
                    ->navigationGroup('Managemen Pengguna')
                    ->navigationLabel('Catatan')
                    ->navigationIcon('')
                    ->logDirs([
                        storage_path('logs'),     // The default value
                    ])
                    ->excludedFilesPatterns([
                        '*2023*',
                    ])
                    ->navigationSort(1)
                    ->slug('logs'),
                AuthUIEnhancerPlugin::make()
                    ->emptyPanelBackgroundImageUrl(asset('images/background/login.png'))
                    ->emptyPanelBackgroundImageOpacity('50%'),
                //                    ->emptyPanelBackgroundColor(Color::Zinc, '300')
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([])
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
