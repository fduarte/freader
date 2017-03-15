<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\ApiData;
use App\Observers\ApiDataObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ApiData::observe(ApiDataObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
