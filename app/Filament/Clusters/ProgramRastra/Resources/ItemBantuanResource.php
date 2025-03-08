<?php

declare(strict_types=1);

namespace App\Filament\Clusters\ProgramRastra\Resources;

use App\Filament\Clusters\ProgramRastra;
use App\Filament\Clusters\ProgramRastra\Resources\ItemBantuanResource\Pages;
use App\Models\ItemBantuan;
use App\Supports\Helpers;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\Village;

class ItemBantuanResource extends Resource
{
    protected static ?string $model = ItemBantuan::class;

    protected static ?string $navigationIcon = null;
    protected static ?string $slug = 'item-bantuan';
    protected static ?string $label = 'Item Bantuan RASTRA';
    protected static ?string $pluralLabel = 'Item Bantuan RASTRA';
    //    protected static ?string $navigationGroup = 'Item Bantuan RASTRA';
    protected static ?int $navigationSort = 4;
    protected static ?string $cluster = ProgramRastra::class;
    protected static ?string $recordTitleAttribute = 'nama_item';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('jenis_bantuan_id')
                    ->relationship('jenisBantuan', 'alias')
                    ->native(false)
                    ->preload()
                    ->required()
                    ->default(5),
                Select::make('kode_kelurahan')
                    ->label('Kelurahan')
                    ->required()
                    ->options(fn() => Village::query()
                        ->when(
                            auth()->user()->instansi_code,
                            fn(Builder $query) => $query->where(
                                'code',
                                auth()->user()->instansi_code,
                            ),
                        )
                        ->whereIn('district_code', config('custom.kode_kecamatan'))
                        ?->pluck('name', 'code'))
                    ->native(false)
                    ->searchable(),
                Forms\Components\TextInput::make('nama_item')
                    ->label('Nama Item')
                    ->default('Beras Premium')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kuantitas')
                    ->numeric()
                    ->default(600),
                Forms\Components\TextInput::make('jumlah_bulan')
                    ->label('Jumlah Bulan')
                    ->numeric()
                    ->default(3),
                Forms\Components\TextInput::make('satuan')
                    ->maxLength(255)
                    ->default('Kg'),
                Forms\Components\TextInput::make('harga_satuan')
                    ->label('Harga Satuan')
                    ->numeric()
                    ->live(onBlur: true)
                    ->default(0)
                    ->afterStateUpdated(
                        fn(Forms\Get $get, Forms\Set $set, $state) => $set('total_harga', $get('kuantitas') * $state),
                    ),
                Forms\Components\TextInput::make('total_harga')
                    ->label('Total Harga')
                    ->numeric()
                    ->disabled()
                    ->dehydrated()
                    ->default(0),
                Forms\Components\Textarea::make('keterangan')
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->emptyStateIcon('heroicon-o-information-circle')
            ->emptyStateHeading('Belum ada item bantuan')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Item Bantuan')
                    ->icon('heroicon-m-plus')
                    ->button(),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('jenisBantuan.alias')
                    ->label('Jenis Bantuan')
                    ->badge()
                    ->color(fn($record) => Color::hex($record->jenisBantuan->warna))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kel.name')
                    ->label('Kelurahan')
                    ->searchable(),
                BadgeableColumn::make('nama_barang')
                    ->searchable()
                    ->suffixBadges([
                        Badge::make('jumlah_bulan')
                            ->label(fn(Model $record) => $record->jumlah_bulan . ' bulan')
                            ->color('info'),
                    ]),
                Tables\Columns\TextColumn::make('kuantitas')
                    ->formatStateUsing(fn($record) => $record->kuantitas . ' ' . $record->satuan)
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga_satuan')
                    ->label('Harga Satuan')
                    ->alignRight()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_harga')
                    ->label('Total Harga')
                    ->alignRight()
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kode_kelurahan')
                    ->label('Kelurahan')
                    ->options(fn() => Village::query()->whereIn(
                        'district_code',
                        config('custom.kode_kecamatan'),
                    )->pluck('name', 'code'))
                    ->searchable()
                    ->preload(),
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

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->hasRole(superadmin_admin_roles())) {
            $query = parent::getEloquentQuery();

            foreach (Helpers::getAdminBantuan() as $role => $jenis) {
                if (auth()->user()->roles()->first()->name === $role) {
                    $query->where('jenis_bantuan_id', $jenis);
                }
            }

            return $query;
        }

        return parent::getEloquentQuery()
            ->where('kelurahan', auth()->user()->instansi_code);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageItemBantuans::route('/'),
        ];
    }
}
