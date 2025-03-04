<?php

declare(strict_types=1);

namespace App\Filament\Pages\Settings;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Closure;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Outerweb\FilamentSettings\Filament\Pages\Settings as BaseSettings;

class Administrasi extends BaseSettings
{
    use HasPageShield;

    protected ?string $heading = 'Pengaturan Administrasi';

    public static function getNavigationLabel(): string
    {
        return 'Administrasi';
    }

    public function getTitle(): string
    {
        return 'Administrasi';
    }

    public function schema(): array|Closure
    {
        return [
            Section::make('Kepala Dinas')
                ->icon('heroicon-o-user')
                ->description('Pengaturan Kepala Dinas, Nip Kepala Dinas, Jabatan Kepala Dinas, dan Pangkat Kepala Dinas')
                ->schema([
                    TextInput::make('persuratan.nama_kepala_dinas')
                        ->label('Nama Kepala Dinas'),
                    TextInput::make('persuratan.nip_kepala_dinas')
                        ->label('NIP Kepala Dinas'),
                    TextInput::make('persuratan.jabatan')
                        ->label('Jabatan Kepala Dinas'),
                    TextInput::make('persuratan.pangkat')
                        ->label('Pangkat Kepala Dinas'),
                ])->aside()->columns(2),
            Section::make('Pejabat Pelaksana Teknis Kegiatan (RASTRA)')
                ->description('Pengaturan Pejabat Pelaksana Kegiatan (RASTRA)')
                ->icon('heroicon-o-user')
                ->schema([
                    TextInput::make('persuratan.nama_pps')
                        ->label('Nama Pejabat'),
                    TextInput::make('persuratan.nip_pps')
                        ->label('Nip Pejabat'),
                    TextInput::make('persuratan.jabatan_pps')
                        ->label('Jabatan Pejabat'),
                    TextInput::make('persuratan.pangkat_pps')
                        ->label('Pangkat Pejabat'),
                    TextInput::make('persuratan.instansi_pps')
                        ->label('Instansi Pejabat')
                        ->default('DINAS SOSIAL KAB. SOPPENG'),
                ])->aside()->columns(2),
            Section::make('Pejabat Pelaksana Teknis Kegiatan (PPKS)')
                ->icon('heroicon-o-user')
                ->description('Pengaturan Pejabat Pelaksana Kegiatan (PPKS)')
                ->schema([
                    TextInput::make('persuratan.nama_ppk')
                        ->label('Nama Pejabat'),
                    TextInput::make('persuratan.nip_ppk')
                        ->label('Nip Pejabat'),
                    TextInput::make('persuratan.jabatan_ppk')
                        ->label('Jabatan Pejabat'),
                    TextInput::make('persuratan.pangkat_ppk')
                        ->label('Pangkat Pejabat'),
                    TextInput::make('persuratan.instansi_ppk')
                        ->label('Instansi Pejabat')
                        ->default('DINAS SOSIAL KAB. SOPPENG'),
                ])->aside()->columns(2),
        ];
    }
}
