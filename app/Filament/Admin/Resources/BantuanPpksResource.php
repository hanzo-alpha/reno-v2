<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BantuanPpksResource\Pages;
use App\Models\BantuanPpks;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BantuanPpksResource extends Resource
{
    protected static ?string $model = BantuanPpks::class;

    protected static ?string $navigationIcon = null;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('bantuan_ppks_uuid')
                    ->maxLength(36)
                    ->default('f6649092-7f1c-4aac-b979-940e7484ed55'),
                Forms\Components\TextInput::make('nokk')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('nik')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('nama_lengkap')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tempat_lahir')
                    ->required()
                    ->maxLength(50),
                Forms\Components\DateTimePicker::make('tgl_lahir')
                    ->required(),
                Forms\Components\TextInput::make('notelp')
                    ->tel()
                    ->required()
                    ->maxLength(18),
                Forms\Components\TextInput::make('nama_ibu_kandung')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('jenis_bantuan_id')
                    ->relationship('jenis_bantuan', 'id')
                    ->default(4),
                Forms\Components\Select::make('pendidikan_terakhir_id')
                    ->relationship('pendidikan_terakhir', 'id')
                    ->required(),
                Forms\Components\Select::make('hubungan_keluarga_id')
                    ->relationship('hubungan_keluarga', 'id')
                    ->required(),
                Forms\Components\Select::make('jenis_pekerjaan_id')
                    ->relationship('jenis_pekerjaan', 'id')
                    ->required(),
                Forms\Components\TextInput::make('status_kawin')
                    ->numeric()
                    ->default(1),
                Forms\Components\TextInput::make('jenis_kelamin')
                    ->numeric()
                    ->default(1),
                Forms\Components\Textarea::make('alamat')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('kecamatan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kelurahan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('dusun')
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_rt')
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_rw')
                    ->maxLength(255),
                Forms\Components\TextInput::make('bukti_foto'),
                Forms\Components\TextInput::make('media_id')
                    ->numeric(),
                Forms\Components\Select::make('tipe_ppks_id')
                    ->relationship('tipe_ppks', 'id'),
                Forms\Components\TextInput::make('kriteria_ppks'),
                Forms\Components\TextInput::make('penghasilan_rata_rata')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('detail_bantuan'),
                Forms\Components\TextInput::make('detail_bantuan_id')
                    ->numeric(),
                Forms\Components\TextInput::make('status_rumah_tinggal')
                    ->numeric(),
                Forms\Components\TextInput::make('status_kondisi_rumah')
                    ->maxLength(255),
                Forms\Components\TextInput::make('status_dtks')
                    ->maxLength(255)
                    ->default('DTKS'),
                Forms\Components\TextInput::make('status_verifikasi')
                    ->maxLength(255)
                    ->default(0),
                Forms\Components\TextInput::make('status_aktif')
                    ->numeric()
                    ->default(0),
                Forms\Components\Textarea::make('keterangan')
                    ->columnSpanFull(),
                Forms\Components\Select::make('penandatangan_id')
                    ->relationship('penandatangan', 'id'),
                Forms\Components\DateTimePicker::make('tgl_ba'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bantuan_ppks_uuid')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nokk')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tempat_lahir')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tgl_lahir')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('notelp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_ibu_kandung')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_bantuan.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pendidikan_terakhir.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hubungan_keluarga.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis_pekerjaan.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_kawin')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kecamatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kelurahan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dusun')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_rt')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_rw')
                    ->searchable(),
                Tables\Columns\TextColumn::make('media_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipe_ppks.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('penghasilan_rata_rata')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('detail_bantuan_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_rumah_tinggal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_kondisi_rumah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_dtks')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_verifikasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_aktif')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('penandatangan.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tgl_ba')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBantuanPpks::route('/'),
            'create' => Pages\CreateBantuanPpks::route('/create'),
            'view' => Pages\ViewBantuanPpks::route('/{record}'),
            'edit' => Pages\EditBantuanPpks::route('/{record}/edit'),
        ];
    }
}
