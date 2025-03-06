<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PenyaluranBantuanRastraResource\Pages;
use App\Models\PenyaluranBantuanRastra;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PenyaluranBantuanRastraResource extends Resource
{
    protected static ?string $model = PenyaluranBantuanRastra::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('penyaluran_bantuan_rastra_uuid')
                    ->required()
                    ->maxLength(36),
                Forms\Components\Select::make('bantuan_rastra_id')
                    ->relationship('bantuan_rastra', 'id'),
                Forms\Components\TextInput::make('no_kk')
                    ->maxLength(255),
                Forms\Components\TextInput::make('nik_kpm')
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('tgl_penyerahan'),
                Forms\Components\TextInput::make('foto_penyerahan')
                    ->required(),
                Forms\Components\TextInput::make('media_id')
                    ->numeric(),
                Forms\Components\Textarea::make('lokasi')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('lat')
                    ->maxLength(255),
                Forms\Components\TextInput::make('lng')
                    ->maxLength(255),
                Forms\Components\TextInput::make('status_penyaluran')
                    ->maxLength(255)
                    ->default('BELUM TERSALURKAN'),
                Forms\Components\Select::make('penandatangan_id')
                    ->relationship('penandatangan', 'id'),
                Forms\Components\TextInput::make('keterangan')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('penyaluran_bantuan_rastra_uuid')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bantuan_rastra.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('no_kk')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nik_kpm')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tgl_penyerahan')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('media_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lng')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_penyaluran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('penandatangan.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('keterangan')
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

            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePenyaluranBantuanRastras::route('/'),
        ];
    }
}
