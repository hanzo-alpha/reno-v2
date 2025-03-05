<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BantuanRastraResource\Pages;
use App\Models\BantuanRastra;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BantuanRastraResource extends Resource
{
    protected static ?string $model = BantuanRastra::class;

    protected static ?string $navigationIcon = null;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('bantuan_rastra_uuid')
                    ->maxLength(36)
                    ->default('8ed5be84-86c5-4147-8acb-3f37fe079ba3'),
                Forms\Components\TextInput::make('nokk')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('nik')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('nama_lengkap')
                    ->required()
                    ->maxLength(255),
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
                Forms\Components\TextInput::make('lat')
                    ->maxLength(255),
                Forms\Components\TextInput::make('lng')
                    ->maxLength(255),
                Forms\Components\Select::make('jenis_bantuan_id')
                    ->relationship('jenis_bantuan', 'id')
                    ->default(5),
                Forms\Components\TextInput::make('status_verifikasi')
                    ->maxLength(255)
                    ->default(0),
                Forms\Components\TextInput::make('status_aktif')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('media_id')
                    ->numeric(),
                Forms\Components\TextInput::make('foto_ktp_kk'),
                Forms\Components\TextInput::make('tahun'),
                Forms\Components\TextInput::make('status_rastra')
                    ->numeric(),
                Forms\Components\TextInput::make('pengganti_rastra'),
                Forms\Components\TextInput::make('keterangan')
                    ->maxLength(255),
                Forms\Components\TextInput::make('status_dtks')
                    ->maxLength(30)
                    ->default('DTKS'),
                Forms\Components\TextInput::make('alamat_lengkap')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bantuan_rastra_uuid')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nokk')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->searchable(),
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
                Tables\Columns\TextColumn::make('lat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lng')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_bantuan.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_verifikasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_aktif')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('media_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tahun'),
                Tables\Columns\TextColumn::make('status_rastra')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('keterangan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_dtks')
                    ->searchable(),
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
                Tables\Columns\TextColumn::make('alamat_lengkap')
                    ->searchable(),
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
            'index' => Pages\ListBantuanRastras::route('/'),
            'create' => Pages\CreateBantuanRastra::route('/create'),
            'view' => Pages\ViewBantuanRastra::route('/{record}'),
            'edit' => Pages\EditBantuanRastra::route('/{record}/edit'),
        ];
    }
}
