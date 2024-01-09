<?php

namespace App\Providers;

use App\Suppliers\CountryManager;
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
        View::composer(['components.custom.data-country-code-select', 'components.custom.data-state-code-select'], function ($view) {
            $view->with('countries', CountryManager::only('US'));
            $view->with('country_code_default', 'US');
            $view->with('state_code_default', 'TX');
        });

        View::composer('components.custom.data-city-name-input', function ($view) {
            $view->with('city_name_default', 'San Antonio');
        });
    }
}
