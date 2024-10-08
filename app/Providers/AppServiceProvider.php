<?php

namespace App\Providers;

use App\Generators\CustomUrlGenerator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('url', function ($app) {
            return new CustomUrlGenerator(
                $app['router']->getRoutes(),
                $app->rebinding('request', function ($app, $request) {
                    $app['url']->setRequest($request);
                })
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app['validator']->extend('uni_regex', function ($attribute, $value, $parameters, $validator) {
            return mb_ereg_match($parameters[0], $value);
        });
     
        $this->app['validator']->replacer('uni_regex', function ($message, $attribute, $rule, $parameters) {
            $message = str_replace(':attribute', $attribute, $message);
            return $message;
        });
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super-admin') ? true : null;
        });
        Schema::defaultStringLength(191);
    }
}
