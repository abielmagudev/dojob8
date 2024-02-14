<?php

namespace App\Providers;

use App\Models\Settings;
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
        $settings = Settings::first();

        View::composer([
            'components.application.navbar',
            'components.application.sidebar-canvas',
            'components.custom.input-city-name-data',
        ], function($view) use ($settings) {
            $view->with('settings', $settings);
        });

        View::composer([
            'components.custom.select-country-code-data',
            'components.custom.select-state-code-data',
        ], function ($view) use ($settings) {
            $view->with('countryManager', CountryManager::singleton());
            $view->with('settings', $settings);
        });
    }
}
