<?php

namespace App\Filament\Admin\Resources;

use App\Enums\StatusAdminEnum;
use App\Filament\Actions\GeneratePasswordAction;
use App\Filament\Admin\Resources\UserResource\Pages\CreateUser;
use App\Filament\Admin\Resources\UserResource\Pages\EditUser;
use App\Filament\Admin\Resources\UserResource\Pages\ListUsers;
use App\Models\Kelurahan;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Laravolt\Indonesia\Models\Village;
use Rmsramos\Activitylog\Actions\ActivityLogTimelineTableAction;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = null;
    protected static ?string $slug = 'pengguna';
    protected static ?string $label = 'Pengguna';
    protected static ?string $pluralLabel = 'Pengguna';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $recordTitleAttribute = 'name';

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'name',
            'email',
        ];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        /** @var User $record */
        return ['email' => $record->email];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->maxLength(255),
                        TextInput::make('password')
                            ->label(__('filament-panels::pages/auth/edit-profile.form.password.label'))
                            ->password()
                            ->unique(ignoreRecord: true)
                            ->required(fn($livewire) => $livewire instanceof CreateUser)
                            ->revealable(filament()->arePasswordsRevealable())
                            ->rule(Password::default())
                            ->autocomplete('new-password')
                            ->dehydrated(fn ($state): bool => filled($state))
                            ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
                            ->live(debounce: 500)
                            ->same('passwordConfirmation')
                            ->suffixActions([
                                GeneratePasswordAction::make(),
                            ]),
                        TextInput::make('passwordConfirmation')
                            ->label(__('filament-panels::pages/auth/edit-profile.form.password_confirmation.label'))
                            ->password()
                            ->revealable(filament()->arePasswordsRevealable())
                            ->required()
                            ->visible(fn (Get $get): bool => filled($get('password')))
                            ->dehydrated(false),
                        Forms\Components\Select::make('roles')
                            ->relationship('roles', 'name')
                            ->preload()
                            ->searchable(),
                        Forms\Components\Select::make('instansi_code')
                            ->nullable()
                            ->unique(ignoreRecord: true)
                            ->options(function () {
                                return Village::query()->whereIn('district_code', config('custom.kode_kecamatan'))
                                    ->pluck('name', 'code');
                            })
                            ->searchable()
                            ->label('Instansi')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set): void {
                                $namaKel = Village::find($state)?->name;
                                if (blank($namaKel)) {
                                    $set('slug', null);
                                    $set('nama_instansi', null);
                                }

                                $set('slug', Str::slug($namaKel));
                                $set('nama_instansi', $namaKel);
                            }),
                        Forms\Components\ToggleButtons::make('is_admin')
                            ->enum(StatusAdminEnum::class)
                            ->options(StatusAdminEnum::class)
                            ->inline(),
                    ])->inlineLabel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at')
            ->emptyStateIcon('heroicon-o-information-circle')
            ->emptyStateHeading('Belum ada pengguna')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah')
                    ->icon('heroicon-m-plus')
                    ->button(),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->placeholder('No Name.')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->placeholder('No Email.')
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->placeholder('No Roles.')
                    ->badge(),
                Tables\Columns\TextColumn::make('instansi_code')
                    ->placeholder('No Instansi.')
                    ->formatStateUsing(fn($state) => Village::find($state)?->name)
                    ->label('Instansi')
                    ->badge(),
                Tables\Columns\TextColumn::make('is_admin')
                    ->badge(),
            ])
            ->toggleColumnsTriggerAction(
                fn(Action $action) => $action
                    ->iconButton()
//                    ->tooltip('Tampilkan / Sembunyikan Kolom Tabel')
                    ->label('Tampilkan / Sembunyikan Kolom Tabel'),
            )
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->closeModalByClickingAway(false),
                Tables\Actions\DeleteAction::make()
                    ->closeModalByClickingAway(false)
                    ->hidden(fn(Model $record) => (1 === $record->id)),
                ActivityLogTimelineTableAction::make('Aktifitas')
                    ->timelineIcons([
                        'created' => 'heroicon-m-check-badge',
                        'updated' => 'heroicon-m-pencil-square',
                    ])
                    ->timelineIconColors([
                        'created' => 'info',
                        'updated' => 'warning',
                    ])
                    ->limit(10),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    BulkAction::make('delete')
                        ->label('Hapus Terpilih')
                        ->icon('heroicon-m-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function (Collection $records): void {
                            $records->each(function ($items): void {
                                $items->delete();
                                $items->syncRoles();
                            });
                        })
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('forceDelete')
                        ->label('Hapus Selamanya')
                        ->icon('heroicon-m-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function (Collection $records): void {
                            $records->each(function ($items): void {
                                $items->forceDelete();
                                $items->syncRoles();
                            });
                        })
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->checkIfRecordIsSelectableUsing(
                fn(Model $record): bool => (StatusAdminEnum::SUPER_ADMIN !== $record->is_admin) || 1 !== $record->id,
            );
    }

    public static function getEloquentQuery(): Builder
    {
        if (1 === auth()->user()->id) {
            return parent::getEloquentQuery()
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]);
        }

        return parent::getEloquentQuery()
            ->whereNot('id', 1)
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
