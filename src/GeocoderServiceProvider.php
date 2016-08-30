<?php

namespace TeamZac\Geocoder;

use Illuminate\Support\ServiceProvider;

class GeocoderServiceProvider extends ServiceProvider
{
    
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/config.php' => config_path('geocoder.php')
            ], 'geocoding-config');

            $this->mergeConfigFrom(
                __DIR__.'/config.php', 'geocoder'
            );

            $this->commands([
                Console\Geocode::class,
                Console\ReverseGeocode::class,
            ]);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Geocoder::class, function($app) {
            return new Geocoder( config('geocoder.google_maps_api_key'))
        });
    }
}