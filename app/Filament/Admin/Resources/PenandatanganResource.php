<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Enums\JabatanEnum;
use App\Enums\StatusPenandatangan;
use App\Filament\Admin\Resources\PenandatanganResource\Pages;
use App\Models\Penandatangan;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

class PenandatanganResource extends Resource
{
    protected static ?string $model = Penandatangan::class;

    protected static ?string $navigationIcon = null;

    protected static ?string $slug = 'penandatangan';

    protected static ?string $label = 'Penandatangan';

    protected static ?string $pluralLabel = 'Penandatangan';

    protected static ?string $navigationLabel = 'Penandatangan';

    protected static ?string $navigationGroup = 'Dashboard Bantuan';

    protected static ?string $recordTitleAttribute = 'nama_penandatangan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('kode_kecamatan')
                    ->label('Kecamatan')
                    ->options(function (Get $get) {
                        return District::where(
                            'city_code',
                            setting('app.kodekab', config('custom.default.kodekab'))
                        )->pluck('name', 'code');
                    })
                    ->searchable()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set): void {
                        $set('kode_instansi', null);
                    })
                    ->required(),
                Select::make('kode_instansi')
                    ->label('Kelurahan')
                    ->options(function (Get $get) {
                        return Village::where('district_code', $get('kode_kecamatan'))->pluck('name', 'code');
                    })
                    ->searchable()
                    ->required(),
                TextInput::make('nama_penandatangan')
                    ->required(),
                TextInput::make('nip')
                    ->required(),
                Select::make('jabatan')
                    ->enum(JabatanEnum::class)
                    ->options(JabatanEnum::class)
                    ->searchable()
                    ->native(false)
                    ->preload()
                    ->required(),

                ToggleButtons::make('status_penandatangan')
                    ->label('Status')
                    ->inline()
                    ->options(StatusPenandatangan::class)
                    ->default(StatusPenandatangan::AKTIF)
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->poll()
            ->defaultSort('jabatan')
            ->emptyStateIcon('heroicon-o-information-circle')
            ->emptyStateHeading('Belum ada penandatangan')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah')
                    ->icon('heroicon-m-plus')
                    ->button(),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('kode_kecamatan')
                    ->label('Kecamatan')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->formatStateUsing(fn ($state): string => District::where('code', $state)->first()?->name ?? '-')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kode_instansi')
                    ->label('Instansi')
                    ->sortable()
                    ->toggleable()
                    ->formatStateUsing(fn ($state): string => Village::where('code', $state)->first()?->name ?? '-')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nip')
                    ->sortable()
                    ->toggleable()
                    ->copyable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_penandatangan')
                    ->label('Nama Penandatangan')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jabatan')
                    ->sortable()
                    ->toggleable()
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_penandatangan')
                    ->label('Status')
                    ->sortable()
                    ->searchable()
                    ->alignCenter()
                    ->badge(),
            ])
            ->filters([
                //                Tables\Filters\SelectFilter::make('kode_instansi')
                //                    ->label('Instansi')
                //                    ->options(Kelurahan::whereIn(
                //                        'kecamatan_code',
                //                        config('custom.kode_kecamatan'),
                //                    )->pluck('name', 'code'))
                //                    ->searchable()
                //                    ->preload(),
                Tables\Filters\SelectFilter::make('status_penandatangan')
                    ->label('Status Penandatangan')
                    ->options(StatusPenandatangan::class)
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('jabatan')
                    ->options(JabatanEnum::class)
                    ->searchable()
                    ->preload(),
            ])
            ->deferLoading()
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
            'index' => Pages\ManagePenandatangans::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->hasRole(superadmin_admin_roles())) {
            return parent::getEloquentQuery();
        }

        return parent::getEloquentQuery()
            ->where('kode_instansi', auth()->user()->instansi_code);
    }
}
