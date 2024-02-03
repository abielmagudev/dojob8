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
        $configuration = Configuration::first();

        View::composer('application.sidebar-canvas', function($view) use ($configuration) {
            $view->with('configuration', $configuration);
        });

        View::composer('components.custom.input-city-name-data', function ($view) use ($configuration) {
            $view->with('configuration', $configuration);
        });

        View::composer([
            'components.custom.select-country-code-data',
            'components.custom.select-state-code-data',
        ], function ($view) use ($configuration) {
            $view->with('countryManager', CountryManager::singleton());
            $view->with('configuration', $configuration);
        });
    }
}
