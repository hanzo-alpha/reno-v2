<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PenggantiRastraResource\Pages;
use App\Models\PenggantiRastra;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PenggantiRastraResource extends Resource
{
    protected static ?string $model = PenggantiRastra::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('pengganti_rastra_uuid')
                    ->required()
                    ->maxLength(36),
                Forms\Components\Select::make('bantuan_rastra_id')
                    ->relationship('bantuan_rastra', 'id'),
                Forms\Components\TextInput::make('nokk_lama')
                    ->maxLength(20),
                Forms\Components\TextInput::make('nik_lama')
                    ->maxLength(20),
                Forms\Components\TextInput::make('nama_lama')
                    ->maxLength(255),
                Forms\Components\Textarea::make('alamat_lama')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('nokk_pengganti')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('nik_pengganti')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('nama_pengganti')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('alamat_pengganti')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('alasan_dikeluarkan')
                    ->maxLength(255)
                    ->default('PINDAH'),
                Forms\Components\TextInput::make('attachment'),
                Forms\Components\TextInput::make('media_id')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pengganti_rastra_uuid')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bantuan_rastra.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nokk_lama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nik_lama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_lama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nokk_pengganti')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nik_pengganti')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_pengganti')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alasan_dikeluarkan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('media_id')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ManagePenggantiRastras::route('/'),
        ];
    }
}
