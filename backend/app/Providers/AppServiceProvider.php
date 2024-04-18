<?php

namespace App\Providers;

use App\Socialite\SkolkovoProvider;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $socialite = $this->app->make(Factory::class);
        $socialite->extend('skolkovo', function ($app) use ($socialite) {
            return $socialite->buildProvider(SkolkovoProvider::class, $app['config']['services.skolkovo']);
        });
    }
}
