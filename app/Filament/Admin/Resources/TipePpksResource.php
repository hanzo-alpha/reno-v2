<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TipePpksResource\Pages;
use App\Models\TipePpks;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;

class TipePpksResource extends Resource
{
    protected static ?string $model = TipePpks::class;

    protected static ?string $navigationIcon = null;

    protected static ?string $slug = 'tipe-ppks';

    protected static ?string $label = 'Tipe PPKS';

    protected static ?string $pluralLabel = 'Tipe PPKS';

    protected static ?string $navigationLabel = 'Tipe PPKS';

    protected static ?string $navigationGroup = 'Dashboard Bantuan';

    protected static ?string $recordTitleAttribute = 'nama_tipe';

    public static function getGloballySearchableAttributes(): array
    {
        return ['nama_tipe', 'alias', 'kriteria_ppks.nama_kriteria'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_tipe')
                    ->label('Nama Tipe')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('alias')
                    ->maxLength(255),
                Forms\Components\Textarea::make('deskripsi')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                TableRepeater::make('kriteria_ppks')
                    ->relationship('kriteriaPpks')
                    ->schema([
                        Forms\Components\TextInput::make('nama_kriteria')
                            ->unique(ignoreRecord: true)
                            ->required(),
                    ])
                    ->minItems(1)
                    ->addActionLabel('Tambah Kriteria PPKS')
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateIcon('heroicon-o-information-circle')
            ->emptyStateHeading('Belum ada tipe PPKS')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah')
                    ->icon('heroicon-m-plus')
                    ->disabled(fn() => cek_batas_input('ppks'))
                    ->button(),
            ])
            ->columns([
                BadgeableColumn::make('nama_tipe')
                    ->label('Kategori PPKS')
                    ->suffixBadges([
                        Badge::make('alias')
                            ->label(fn($record) => $record->alias)
                            ->color('success'),
                    ])
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kriteria_ppks.nama_kriteria')
                    ->label('Kriteria PPKS')
                    ->badge()
                    ->color('primary')
                    ->inline()
                    ->searchable(),
            ])
            ->filters([

            ])
            ->actions([
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
            'index' => Pages\ManageTipePpks::route('/'),
        ];
    }
}
