<?php

namespace App\Filament\Clusters\ProgramRastra\Resources;

use App\Filament\Clusters\ProgramRastra;
use App\Filament\Clusters\ProgramRastra\Resources\LokasiBantuanResource\Pages;
use App\Filament\Clusters\ProgramRastra\Resources\LokasiBantuanResource\RelationManagers;
use App\Models\LokasiBantuan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LokasiBantuanResource extends Resource
{
    protected static ?string $model = LokasiBantuan::class;

    protected static ?string $navigationIcon = 'heroicon-m-arrow-down-right';
    protected static ?string $slug = 'lokasi-bantuan';
    protected static ?string $label = 'Lokasi Bantuan';
    protected static ?string $pluralLabel = 'Lokasi Bantuan';
    protected static ?string $navigationLabel = 'Lokasi Bantuan';
    protected static ?string $recordTitleAttribute = 'lokasi';
    protected static ?int $navigationSort = 5;
    protected static ?string $cluster = ProgramRastra::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('lokasi_bantuan_uuid')
                            ->default(\Str::uuid()->toString())
                            ->maxLength(36),
                        Forms\Components\Select::make('bantuan_rastra_id')
                            ->relationship('bantuanRastra', 'id'),
                        \Cheesegrits\FilamentGoogleMaps\Fields\Map::make('lokasi')
                            ->required()
                            ->mapControls([
                                'mapTypeControl' => true,
                                'scaleControl' => true,
                                'streetViewControl' => true,
                                'rotateControl' => true,
                                'fullscreenControl' => true,
                                'searchBoxControl' => false,
                                'zoomControl' => false,
                            ])
                            ->height(fn() => '60vh')
                            ->defaultZoom(15)
                            ->clickable()
                            ->draggable()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                $set('latitude', $state['lat']);
                                $set('longitude', $state['lng']);
                            })
                            ->geolocate()
                            ->geolocateOnLoad()
                            ->defaultLocation([119.8968, -4.3666])
                            ->columnSpanFull()
                            ->reverseGeocode([
                                'country' => '%C',
                                'city' => '%L',
                                'city_district' => '%D',
                                'zip' => '%z',
                                'state' => '%A1',
                                'street' => '%S %n',
                            ]),
                        Forms\Components\TextInput::make('latitude')
                            ->label('Latitude')
                            ->readOnly()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                $set('location', [
                                    'lat' => floatVal($state),
                                    'lng' => floatVal($get('longitude')),
                                ]);
                            })
                            ->lazy(),
                        Forms\Components\TextInput::make('longitude')
                            ->label('Longitude')
                            ->readOnly()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                $set('location', [
                                    'lat' => floatval($get('latitude')),
                                    'lng' => floatVal($state),
                                ]);
                            })
                            ->lazy(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('lokasi_bantuan_uuid')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bantuanRastra.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lokasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('latitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('longitude')
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
            'index' => Pages\ListLokasiBantuans::route('/'),
            'create' => Pages\CreateLokasiBantuan::route('/create'),
            'view' => Pages\ViewLokasiBantuan::route('/{record}'),
            'edit' => Pages\EditLokasiBantuan::route('/{record}/edit'),
        ];
    }
}
