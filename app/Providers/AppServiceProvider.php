<?php

namespace App\Providers;

use App\Models\Property;
use App\Observers\PropertyObserve;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //$this->app->bind('App\Repositories\UserRepositoryInterface', UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Property::observe(PropertyObserve::class);
    }
}
