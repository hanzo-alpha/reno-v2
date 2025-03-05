<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BantuanPkhResource\Pages;
use App\Filament\Admin\Resources\BantuanPkhResource\RelationManagers;
use App\Models\BantuanPkh;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BantuanPkhResource extends Resource
{
    protected static ?string $model = BantuanPkh::class;

    protected static ?string $navigationIcon = null;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('bantuan_pkh_uuid')
                    ->maxLength(36)
                    ->default('c1018a4e-716f-4fc5-9425-c106b8c39662'),
                Forms\Components\TextInput::make('nokk')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nik_ktp')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_penerima')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kode_wilayah')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('tahap')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('bansos')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('jenis_bantuan_id')
                    ->relationship('jenis_bantuan', 'id')
                    ->default(1),
                Forms\Components\TextInput::make('nominal')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('bank')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('provinsi')
                    ->maxLength(2),
                Forms\Components\TextInput::make('kabupaten')
                    ->maxLength(5),
                Forms\Components\TextInput::make('kecamatan')
                    ->maxLength(7),
                Forms\Components\TextInput::make('kelurahan')
                    ->maxLength(10),
                Forms\Components\TextInput::make('alamat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_rt')
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_rw')
                    ->maxLength(255),
                Forms\Components\TextInput::make('dusun')
                    ->maxLength(255),
                Forms\Components\TextInput::make('dir')
                    ->maxLength(255),
                Forms\Components\TextInput::make('gelombang')
                    ->maxLength(255),
                Forms\Components\TextInput::make('tahun'),
                Forms\Components\TextInput::make('status_pkh')
                    ->maxLength(255)
                    ->default('PKH'),
                Forms\Components\TextInput::make('status_dtks')
                    ->maxLength(30)
                    ->default('DTKS'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bantuan_pkh_uuid')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nokk')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nik_ktp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_penerima')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kode_wilayah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tahap')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bansos')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_bantuan.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nominal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bank')
                    ->searchable(),
                Tables\Columns\TextColumn::make('provinsi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kabupaten')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kecamatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kelurahan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_rt')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_rw')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dusun')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dir')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gelombang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tahun'),
                Tables\Columns\TextColumn::make('status_pkh')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_dtks')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListBantuanPkhs::route('/'),
            'create' => Pages\CreateBantuanPkh::route('/create'),
            'view' => Pages\ViewBantuanPkh::route('/{record}'),
            'edit' => Pages\EditBantuanPkh::route('/{record}/edit'),
        ];
    }
}
