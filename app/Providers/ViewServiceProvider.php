<?php

namespace App\Providers;

use App\Helpers\CountryManager;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['components.custom.select-country-code', 'components.custom.select-state-code'], function ($view) {
            $view->with('countries', CountryManager::only('US'));
            $view->with('country_code_default', 'US');
            $view->with('state_code_default', 'TX');
        });

        View::composer('components.custom.input-city', function ($view) {
            $view->with('city_default', 'San Antonio');
        });
    }
}
