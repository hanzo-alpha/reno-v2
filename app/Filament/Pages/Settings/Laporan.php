<?php

declare(strict_types=1);

namespace App\Filament\Pages\Settings;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Closure;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Outerweb\FilamentSettings\Filament\Pages\Settings as BaseSettings;

class Laporan extends BaseSettings
{
    use HasPageShield;

    protected ?string $heading = 'Pengaturan Laporan';

    public static function getNavigationLabel(): string
    {
        return 'Laporan';
    }

    public function getTitle(): string
    {
        return 'Laporan';
    }

    public function schema(): array|Closure
    {
        return [
            Section::make('Kop Berita Acara & Layout')
                ->icon('heroicon-o-document-text')
                ->description('Pengaturan Laporan Berita Acara, Kop Berita Acara, dan Layout Kop Berita Acara')
                ->schema([
                    TextInput::make('ba.kop_title')
                        ->label('Kop Judul')
                        ->default('PEMERINTAH KABUPATEN SOPPENG'),
                    TextInput::make('ba.kop_instansi')
                        ->label('Kop Instansi')
                        ->default('DINAS SOSIAL'),
                    TextInput::make('ba.kop_website')
                        ->label('Kop Website'),
                    TextInput::make('ba.kop_jalan')
                        ->label('Kop Jalan')
                        ->default('Jalan Salotungo Kel. Lalabata Rilau Kec. Lalabata Watansoppeng'),
                    TextInput::make('ba.kop_ba')
                        ->label('Kop Judul Berita Acara')
                        ->default('BERITA ACARA SERAH TERIMA BARANG'),
                    ToggleButtons::make('ba.kop_layout')
                        ->label('Layout Kop/Judul Berita Acara')
                        ->inline()
                        ->boolean(),
                ])->aside()->columns(2),
            Section::make('Umum')
                ->description('Pengaturan Nomor Surat, Pemisah Nomor Surat, Simbol Nomor Surat, dan Instansi Nomor Surat')
                ->icon('heroicon-o-document-text')
                ->schema([
                    TextInput::make('app.separator')
                        ->label('Pemisah Nomor Surat'),
                    TextInput::make('app.pad')
                        ->label('Simbol Nomor Surat'),
                    TextInput::make('app.alias_dinas')
                        ->label('Instansi Nomor Surat'),
                ])->aside()->columns(3),
            Section::make('Berita Acara Rastra')
                ->description('Pengaturan Judul No. Berita Acara RASTRA, Nomor Dinas, dan Nomor Berita Acara RASTRA')
                ->icon('heroicon-o-document-text')
                ->schema([
                    TextInput::make('rastra.judul_no')
                        ->label('Judul No. Berita Acara'),

                ])->aside()->columns(2),
            Section::make('Berita Acara PPKS')
                ->icon('heroicon-o-document-text')
                ->description('Pengaturan Judul No. Berita Acara PPKS, Nomor Dinas, dan Nomor Berita Acara PPKS')
                ->schema([
                    TextInput::make('ppks.judul_no')
                        ->label('Judul No. Berita Acara'),
                    TextInput::make('ppks.no_ppks')
                        ->label('Nomor Dinas'),
                    TextInput::make('ppks.no_ba')
                        ->label('Nomor Berita Acara PPKS'),
                ])->aside()->columns(2),
        ];
    }
}
