<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\HubunganKeluargaResource\Pages;
use App\Models\HubunganKeluarga;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

final class HubunganKeluargaResource extends Resource
{
    protected static ?string $model = HubunganKeluarga::class;

    protected static ?string $navigationIcon = null;

    protected static ?string $slug = 'hubungan-keluarga';

    protected static ?string $label = 'Hubungan Keluarga';

    protected static ?string $pluralLabel = 'Hubungan Keluarga';

    protected static ?string $navigationGroup = 'Dashboard Bantuan';

    protected static ?string $recordTitleAttribute = 'nama_hubungan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_hubungan')
                    ->label('Nama Hubungan')
                    ->required()
                    ->autofocus(),
            ])->columns(1)
            ->inlineLabel();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateIcon('heroicon-o-information-circle')
            ->emptyStateHeading('Belum ada hubungan keluarga')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah')
                    ->icon('heroicon-m-plus')
                    ->button(),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('nama_hubungan'),
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
            'index' => Pages\ManageHubunganKeluargas::route('/'),
        ];
    }
}
