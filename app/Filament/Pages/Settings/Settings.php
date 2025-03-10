<?php

declare(strict_types=1);

namespace App\Filament\Pages\Settings;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Closure;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Outerweb\FilamentSettings\Filament\Pages\Settings as BaseSettings;

class Settings extends BaseSettings
{
    use HasPageShield;

    protected ?string $heading = 'Pengaturan Umum';

    protected static ?string $navigationIcon = null;

    public static function getNavigationLabel(): string
    {
        return 'Umum';
    }

    public function getTitle(): string
    {
        return 'Umum';
    }

    public function schema(): array | Closure
    {
        return [
            Section::make('Aplikasi & Tema')
                ->icon('heroicon-o-computer-desktop')
                ->description('Pengaturan Nama Aplikasi, Deskripsi, Versi, dan Tema Dark Mode')
                ->schema([
                    TextInput::make('app.brand_name')
                        ->label('Nama Aplikasi')
                        ->default('RENO'),
                    TextInput::make('app.brand_description')
                        ->label('Deskripsi Aplikasi')
                        ->default('RENO'),
                    TextInput::make('app.version')
                        ->label('Versi Aplikasi')
                        ->default('v1.0.0'),
                    ToggleButtons::make('app.darkmode')
                        ->inline()
                        ->boolean(),
                ])
                ->columns(2)
                ->aside(),
            Section::make('Wilayah & Format Tanggal')
                ->icon('heroicon-o-bars-4')
                ->description('Pengaturan Kode Provinsi, Kode Kabupaten, Kode POS, dan Format Tanggal')
                ->schema([
                    TextInput::make('app.kodeprov')
                        ->label('Kode Provinsi'),
                    TextInput::make('app.kodekab')
                        ->label('Kode Kabupaten'),
                    TextInput::make('app.kodepos')
                        ->label('Kode POS'),
                    Select::make('app.format_tgl')
                        ->label('Format Tanggal')
                        ->options([
                            'd-m-Y' => 'dd-mm-yyyy',
                            'Y-m-d' => 'yyyy-mm-dd',
                            'd/m/Y' => 'dd/mm/yyyy',
                            'Y/m/d' => 'yyyy/mm/dd',
                            'd.m.Y' => 'dd.mm.yyyy',
                            'Y.m.d' => 'yyyy.mm.dd',
                            'd F Y' => 'dd mm yyyy',
                        ]),

                ])->columns(2)->aside(),
            Section::make('Pendukung Aplikasi')
                ->icon('heroicon-o-lifebuoy')
                ->description('Pengaturan Angka Kemiskinan, Warna Angka Kemiskinan, dan Batas Tanggal Penginputan Data Bantuan')
                ->schema([
                    TextInput::make('app.angka_kemiskinan')
                        ->label('Angka Kemiskinan'),
                    TextInput::make('app.angka_kemiskinan_persen')
                        ->mask('9.99')
                        ->label('Angka Kemiskinan (%)'),
                    ColorPicker::make('app.warna_kemiskinan')
                        ->label('Warna Angka Kemiskinan'),
                ])->aside()->columns(2),
            Section::make('Batas Tanggal Penginputan Data Bantuan')
                ->icon('heroicon-o-calendar-days')
                ->description('Pengaturan Batas Tanggal Penginputan Data Bantuan')
                ->schema([
                    DatePicker::make('app.batas_tgl_input')
                        ->label('Batas Tanggal Penginputan Data')
                        ->date()
                        ->displayFormat(setting('app.format_tgl')),
                    DatePicker::make('app.batas_tgl_input_bpjs')
                        ->label('Batas Tanggal Input Data BPJS')
                        ->date()
                        ->displayFormat(setting('app.format_tgl')),
                    DatePicker::make('app.batas_tgl_input_mutasi')
                        ->label('Batas Tanggal Penginputan Data Mutasi BPJS')
                        ->date()
                        ->displayFormat(setting('app.format_tgl')),
                    DatePicker::make('app.batas_tgl_input_rastra')
                        ->label('Batas Tanggal Input Data RASTRA')
                        ->date()
                        ->displayFormat(setting('app.format_tgl')),
                    DatePicker::make('app.batas_tgl_input_ppks')
                        ->label('Batas Tanggal Input Data PPKS')
                        ->date()
                        ->displayFormat(setting('app.format_tgl')),

                ])->aside()->columns(2),
            //            Tabs::make('Pengaturan')
            //                ->schema([
            //                    Tabs\Tab::make('Aplikasi')
            //                        ->icon('heroicon-o-computer-desktop')
            //                        ->schema([
            //                            Group::make([
            //                                Section::make('Sistem')
            //                                    ->icon('heroicon-o-computer-desktop')
            //                                    ->schema([
            //                                        TextInput::make('app.brand_name')
            //                                            ->label('Nama Aplikasi')
            //                                            ->default('RENO'),
            //                                        TextInput::make('app.brand_description')
            //                                            ->label('Deskripsi Aplikasi')
            //                                            ->default('RENO'),
            //                                        TextInput::make('app.version')
            //                                            ->label('Versi Aplikasi')
            //                                            ->default('v1.0.0'),
            //                                        ToggleButtons::make('app.darkmode')
            //                                            ->inline()
            //                                            ->boolean(),
            //                                    ])->columns(2),
            //                                Section::make('Default')
            //                                    ->icon('heroicon-o-bars-4')
            //                                    ->schema([
            //                                        TextInput::make('app.kodeprov')
            //                                            ->label('Kode Provinsi'),
            //                                        TextInput::make('app.kodekab')
            //                                            ->label('Kode Kabupaten'),
            //                                        TextInput::make('app.kodepos')
            //                                            ->label('Kode POS'),
            //                                        Select::make('app.format_tgl')
            //                                            ->label('Format Tanggal')
            //                                            ->options([
            //                                                'd-m-Y' => 'dd-mm-yyyy',
            //                                                'Y-m-d' => 'yyyy-mm-dd',
            //                                                'd/m/Y' => 'dd/mm/yyyy',
            //                                                'Y/m/d' => 'yyyy/mm/dd',
            //                                                'd.m.Y' => 'dd.mm.yyyy',
            //                                                'Y.m.d' => 'yyyy.mm.dd',
            //                                                'd F Y' => 'dd mm yyyy',
            //                                            ]),
            //
            //                                    ])->columns(2),
            //                            ]),
            //                            Group::make([
            //                                Section::make('Pendukung Aplikasi')
            //                                    ->icon('heroicon-o-lifebuoy')
            //                                    ->schema([
            //                                        TextInput::make('app.angka_kemiskinan')
            //                                            ->label('Angka Kemiskinan'),
            //                                        TextInput::make('app.angka_kemiskinan_persen')
            //                                            ->mask('9.99')
            //                                            ->label('Angka Kemiskinan (%)'),
            //                                        ColorPicker::make('app.warna_kemiskinan')
            //                                            ->label('Warna Angka Kemiskinan'),
            //                                    ])->columns(2),
            //                                Section::make('Batas Tanggal Penginputan Data Bantuan')
            //                                    ->icon('heroicon-o-calendar-days')
            //                                    ->schema([
            //                                        DatePicker::make('app.batas_tgl_input')
            //                                            ->label('Batas Tanggal Penginputan Data')
            //                                            ->date()
            //                                            ->displayFormat(setting('app.format_tgl')),
            //                                        DatePicker::make('app.batas_tgl_input_bpjs')
            //                                            ->label('Batas Tanggal Input Data BPJS')
            //                                            ->date()
            //                                            ->displayFormat(setting('app.format_tgl')),
            //                                        DatePicker::make('app.batas_tgl_input_mutasi')
            //                                            ->label('Batas Tanggal Penginputan Data Mutasi BPJS')
            //                                            ->date()
            //                                            ->displayFormat(setting('app.format_tgl')),
            //                                        DatePicker::make('app.batas_tgl_input_rastra')
            //                                            ->label('Batas Tanggal Input Data RASTRA')
            //                                            ->date()
            //                                            ->displayFormat(setting('app.format_tgl')),
            //                                        DatePicker::make('app.batas_tgl_input_ppks')
            //                                            ->label('Batas Tanggal Input Data PPKS')
            //                                            ->date()
            //                                            ->displayFormat(setting('app.format_tgl')),
            //
            //                                    ])->columns(2),
            //                            ]),
            //                        ])->columns(2),
            //                    Tabs\Tab::make('Pejabat Pelaksana Kegiatan')
            //                        ->icon('heroicon-o-envelope')
            //                        ->schema([
            //                            Group::make([
            //                                Section::make('Kepala Dinas')
            //                                    ->icon('heroicon-o-user')
            //                                    ->schema([
            //                                        TextInput::make('persuratan.nama_kepala_dinas')
            //                                            ->label('Nama Kepala Dinas'),
            //                                        TextInput::make('persuratan.nip_kepala_dinas')
            //                                            ->label('NIP Kepala Dinas'),
            //                                        TextInput::make('persuratan.jabatan')
            //                                            ->label('Jabatan Kepala Dinas'),
            //                                        TextInput::make('persuratan.pangkat')
            //                                            ->label('Pangkat Kepala Dinas'),
            //                                    ])->columns(2),
            //                            ]),
            //                            Group::make([
            //                                Section::make('Pejabat Pelaksana Teknis Kegiatan (RASTRA)')
            //                                    ->icon('heroicon-o-user')
            //                                    ->schema([
            //                                        TextInput::make('persuratan.nama_pps')
            //                                            ->label('Nama Pejabat'),
            //                                        TextInput::make('persuratan.nip_pps')
            //                                            ->label('Nip Pejabat'),
            //                                        TextInput::make('persuratan.jabatan_pps')
            //                                            ->label('Jabatan Pejabat'),
            //                                        TextInput::make('persuratan.pangkat_pps')
            //                                            ->label('Pangkat Pejabat'),
            //                                        TextInput::make('persuratan.instansi_pps')
            //                                            ->label('Instansi Pejabat')
            //                                            ->default('DINAS SOSIAL KAB. SOPPENG'),
            //                                    ])->columns(2),
            //                                Section::make('Pejabat Pelaksana Teknis Kegiatan (PPKS)')
            //                                    ->icon('heroicon-o-user')
            //                                    ->schema([
            //                                        TextInput::make('persuratan.nama_ppk')
            //                                            ->label('Nama Pejabat'),
            //                                        TextInput::make('persuratan.nip_ppk')
            //                                            ->label('Nip Pejabat'),
            //                                        TextInput::make('persuratan.jabatan_ppk')
            //                                            ->label('Jabatan Pejabat'),
            //                                        TextInput::make('persuratan.pangkat_ppk')
            //                                            ->label('Pangkat Pejabat'),
            //                                        TextInput::make('persuratan.instansi_ppk')
            //                                            ->label('Instansi Pejabat')
            //                                            ->default('DINAS SOSIAL KAB. SOPPENG'),
            //                                    ])->columns(2),
            //                            ]),
            //                        ])->columns(2),
            //
            //                    Tabs\Tab::make('Berita Acara & Penyaluran')
            //                        ->schema([
            //                            Group::make([
            //                                Section::make('Kop Berita Acara & Layout')
            //                                    ->icon('heroicon-o-envelope')
            //                                    ->schema([
            //                                        TextInput::make('ba.kop_title')
            //                                            ->label('Kop Judul')
            //                                            ->default('PEMERINTAH KABUPATEN SOPPENG'),
            //                                        TextInput::make('ba.kop_instansi')
            //                                            ->label('Kop Instansi')
            //                                            ->default('DINAS SOSIAL'),
            //                                        TextInput::make('ba.kop_website')
            //                                            ->label('Kop Website'),
            //                                        TextInput::make('ba.kop_jalan')
            //                                            ->label('Kop Jalan')
            //                                            ->default('Jalan Salotungo Kel. Lalabata Rilau Kec. Lalabata Watansoppeng'),
            //                                        TextInput::make('ba.kop_ba')
            //                                            ->label('Kop Judul Berita Acara')
            //                                            ->default('BERITA ACARA SERAH TERIMA BARANG'),
            //                                        ToggleButtons::make('ba.kop_layout')
            //                                            ->label('Layout Kop/Judul Berita Acara')
            //                                            ->inline()
            //                                            ->boolean(),
            //                                    ])->columns(2),
            //                                Section::make('Umum')
            //                                    ->icon('heroicon-o-envelope')
            //                                    ->schema([
            //                                        TextInput::make('app.separator')
            //                                            ->label('Pemisah Nomor Surat'),
            //                                        TextInput::make('app.pad')
            //                                            ->label('Simbol Nomor Surat'),
            //                                        TextInput::make('app.alias_dinas')
            //                                            ->label('Instansi Nomor Surat'),
            //                                    ])->columns(3),
            //                            ]),
            //                            Group::make([
            //                                Section::make('Berita Acara Rastra')
            //                                    ->icon('heroicon-o-code-bracket')
            //                                    ->schema([
            //                                        TextInput::make('rastra.judul_no')
            //                                            ->label('Judul No. Berita Acara'),
            //
            //                                    ])->columns(2),
            //                                Section::make('Berita Acara PPKS')
            //                                    ->icon('heroicon-o-code-bracket')
            //                                    ->schema([
            //                                        TextInput::make('ppks.judul_no')
            //                                            ->label('Judul No. Berita Acara'),
            //                                        TextInput::make('ppks.no_ppks')
            //                                            ->label('Nomor Dinas'),
            //                                        TextInput::make('ppks.no_ba')
            //                                            ->label('Nomor Berita Acara PPKS'),
            //                                    ])->columns(2),
            //                            ]),
            //                        ])->columns(2),
            //                ]),
        ];
    }
}
