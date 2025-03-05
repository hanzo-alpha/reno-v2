<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BantuanBpntResource\Pages;
use App\Filament\Admin\Resources\BantuanBpntResource\RelationManagers;
use App\Models\BantuanBpnt;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BantuanBpntResource extends Resource
{
    protected static ?string $model = BantuanBpnt::class;

    protected static ?string $navigationIcon = null;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('bantuan_bpnt_uuid')
                    ->maxLength(36)
                    ->default('5e88f1fe-e05f-4a50-bacd-d8e8b845cc0d'),
                Forms\Components\TextInput::make('jenis_bantuan_id')
                    ->numeric()
                    ->default(2),
                Forms\Components\TextInput::make('no_nik')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_penerima')
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
                Forms\Components\TextInput::make('status_dtks')
                    ->maxLength(30)
                    ->default('DTKS'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bantuan_bpnt_uuid')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_bantuan_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('no_nik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_penerima')
                    ->searchable(),
                Tables\Columns\TextColumn::make('provinsi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kabupaten')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kecamatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kelurahan')
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
            'index' => Pages\ListBantuanBpnts::route('/'),
            'create' => Pages\CreateBantuanBpnt::route('/create'),
            'view' => Pages\ViewBantuanBpnt::route('/{record}'),
            'edit' => Pages\EditBantuanBpnt::route('/{record}/edit'),
        ];
    }
}
