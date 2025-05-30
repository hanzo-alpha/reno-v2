<?php

declare(strict_types=1);

namespace App\Filament\Clusters\ProgramRastra\Resources;

use App\Enums\AlasanEnum;
use App\Filament\Clusters\ProgramRastra;
use App\Filament\Clusters\ProgramRastra\Resources\PenggantiRastraResource\Pages;
use App\Models\BantuanRastra;
use App\Models\PenggantiRastra;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class PenggantiRastraResource extends Resource
{
    protected static ?string $model = PenggantiRastra::class;

    protected static ?string $navigationIcon = 'heroicon-m-arrow-down-right';
    protected static ?string $slug = 'pengganti-rastra';
    protected static ?string $label = 'Pengganti RASTRA';
    protected static ?string $pluralLabel = 'Pengganti RASTRA';
    protected static ?string $navigationLabel = 'Pengganti RASTRA';
    //    protected static ?string $navigationGroup = 'Program Sosial';
    protected static ?string $recordTitleAttribute = 'nama_pengganti';
    protected static ?int $navigationSort = 2;
    protected static ?string $cluster = ProgramRastra::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('bantuan_rastra_id')
                    ->relationship('bantuan_rastra', 'nama_lengkap')
                    ->label('Penerima Manfaat Rastra')
                    ->searchable()
                    ->native(false)
                    ->preload()
                    ->getSearchResultsUsing(fn(string $search): array => BantuanRastra::where(
                        'nama_lengkap',
                        'like',
                        "%{$search}%",
                    )
                        ->orWhere('nik', 'like', "%{$search}%")
                        ->orWhere('nokk', 'like', "%{$search}%")
                        ->limit(50)->pluck('nik', 'id')->toArray())
                    ->getOptionLabelFromRecordUsing(fn(
                        $record,
                    ) => '<strong>' . $record?->nik . '</strong><br>' . $record?->nama_lengkap)->allowHtml()
                    ->lazy()
                    ->optionsLimit(15)
                    ->searchingMessage('Sedang mencari...')
                    ->noSearchResultsMessage('Data Tidak ditemukan.')
                    ->visibleOn(['create'])
                    ->required(),
                TextInput::make('nokk_pengganti')
                    ->label('No. KK Pengganti')
                    ->required()
                    ->live(debounce: 500)
                    ->afterStateUpdated(function (Page $livewire, TextInput $component): void {
                        $livewire->validateOnly($component->getStatePath());
                    })
                    ->minLength(16)
                    ->maxLength(16),
                TextInput::make('nik_pengganti')
                    ->label('NIK Pengganti')
                    ->required()
                    ->live(debounce: 500)
                    ->afterStateUpdated(function (Page $livewire, TextInput $component): void {
                        $livewire->validateOnly($component->getStatePath());
                    })
                    ->minLength(16)
                    ->maxLength(16),
                TextInput::make('nama_pengganti')
                    ->label('Nama Pengganti')
                    ->required(),
                TextInput::make('alamat_pengganti')
                    ->label('Alamat Pengganti')
                    ->required(),
                Select::make('alasan_dikeluarkan')
                    ->searchable()
                    ->options(AlasanEnum::class)
                    ->native(false)
                    ->preload()
                    ->lazy()
                    ->required()
                    ->default(AlasanEnum::PINDAH)
                    ->optionsLimit(15),
                CuratorPicker::make('media_id')
                    ->label('Upload Berita Acara Pengganti')
                    ->relationship('beritaAcara', 'id')
                    ->buttonLabel('Tambah File')
                    ->required()
                    ->preserveFilenames()
                    ->rules(['required'])
                    ->maxSize(2048),
            ])->columns(1)->inlineLabel();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll()
            ->deferLoading()
            ->defaultSort('created_at', 'desc')
            ->emptyStateIcon('heroicon-o-information-circle')
            ->emptyStateHeading('Belum ada pengganti RASTRA')
//            ->emptyStateActions([
//                Tables\Actions\CreateAction::make()
//                    ->label('Tambah')
//                    ->icon('heroicon-m-plus')
//                    ->button(),
//            ])
            ->columns([
                Tables\Columns\TextColumn::make('nik_pengganti')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn($state) => Str::mask($state, '*', 2, 12))
                    ->description(fn($record) => Str::mask($record->nokk_pengganti, '*', 2, 12))
                    ->label('NIK & NO. KK Baru'),
                Tables\Columns\TextColumn::make('nama_pengganti')
                    ->searchable()
                    ->sortable()
                    ->description(fn($record) => $record->alamat_pengganti)
                    ->label('NAMA & ALAMAT BARU'),
                Tables\Columns\TextColumn::make('nokk_lama')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn($state) => Str::mask($state, '*', 2, 12))
                    ->description(fn($record) => Str::mask($record->nik_lama, '*', 2, 12))
                    ->label('NIK & NO.KK Lama'),
                Tables\Columns\TextColumn::make('nama_lama')
                    ->searchable()
                    ->sortable()
                    ->description(fn($record) => $record->alamat_lama)
                    ->label('NAMA & ALAMAT LAMA'),
                Tables\Columns\TextColumn::make('alasan_dikeluarkan')
                    ->label('Alasan Dikeluarkan')
                    ->alignCenter()
                    ->badge(),
                CuratorColumn::make('beritaAcara')
                    ->label('Berita Acara')
                    ->size(60),
            ])
            ->filters([
                SelectFilter::make('alasan_dikeluarkan')
                    ->label('Alasan Dikeluarkan')
                    ->options(AlasanEnum::class)
                    ->native(false)
                    ->searchable(),
            ])
            ->deferFilters()
            ->actions([
                Tables\Actions\ViewAction::make(),
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

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->hasRole(superadmin_admin_roles())) {
            return parent::getEloquentQuery();
        }

        return parent::getEloquentQuery();
        //            ->where('kelurahan', auth()->user()->instansi_id;
    }
}
