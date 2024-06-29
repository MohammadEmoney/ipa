<?php

namespace App\Providers;

use App\Repositories\SettingsRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SettingsRepository::class, function ($app) {
            return new SettingsRepository();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $view->with('settings', app(SettingsRepository::class)->get()?->data);
            $view->with('logo', app(SettingsRepository::class)->get()?->getFirstMediaUrl('logo'));
            $view->with('favicon', app(SettingsRepository::class)->get()?->getFirstMediaUrl('favicon'));
        });
    }
}
