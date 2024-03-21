<?php

namespace App\Providers;

use App\Models\Configuration;
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
        View::composer([
            'components.application.navbar',
            'components.application.sidebar-canvas',
            'components.custom.input-city-name-data',
            'components.custom.select-state-code-data',
            'components.custom.select-country-code-data',
        ], function($view) {
            $view->with('configuration', Configuration::singleton());
        });

        View::composer([
            'components.custom.select-country-code-data',
            'components.custom.select-state-code-data',
        ], function ($view) {
            $view->with('countryManager', CountryManager::singleton());
        });
    }
}
