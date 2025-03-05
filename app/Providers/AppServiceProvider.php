<?php

namespace App\Providers;

use App\Policies\ActivityPolicy;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Placeholder;
use Filament\Infolists\Components\Entry;
use Filament\Support\Components\Component;
use Filament\Support\Concerns\Configurable;
use Filament\Tables\Columns\Column;
use Filament\Tables\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Number;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    protected function translatableComponents(): void
    {
        foreach ([Field::class, BaseFilter::class, Placeholder::class, Column::class, Entry::class] as $component) {
            /* @var Configurable $component */
            $component::configureUsing(function (Component $translatable): void {
                /** @phpstan-ignore method.notFound */
                $translatable->translateLabel();
            });
        }
    }

    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands($this->app->isProduction());
    }

    private function configureLocales(): void
    {
        setlocale(LC_ALL, 'IND');
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        Number::useLocale('id');
    }

    private function configureTesting(): void
    {
        if (config('app.env') === 'testing') {
            $this->app->useDatabasePath(base_path('tests/database'));
        }
    }

    private function configureFilamentColumns(): void
    {
        Column::configureUsing(function (Column $column): void {
            $column
                ->toggleable()
                ->sortable()
                ->searchable();
        });
    }

    private function configureModels(): void
    {
        Model::shouldBeStrict(!$this->app->isProduction());
        Model::unguard();
    }

    private function configureAuthorization(): void
    {
        Gate::policy(\Spatie\Activitylog\Models\Activity::class, ActivityPolicy::class);
    }

    public function boot(): void
    {
        $this->configureCommands();
        $this->configureModels();
        $this->translatableComponents();
        $this->configureLocales();
        $this->configureTesting();
        $this->configureFilamentColumns();
        $this->configureAuthorization();
    }
}
