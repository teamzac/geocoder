<?php

namespace TeamZac\Geocoder\Test;

use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            'TeamZac\Geocoder\GeocoderServiceProvider',
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Geocoder' => 'TeamZac\Geocoder\Facades\Geocoder',
        ];
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        if (file_exists($testConfigFile = __DIR__.'/../.env.testing.php')) {
            $testConfig = include $testConfigFile;
            $app['config']->set('geocoder.google_maps_api_key', $testConfig['api_key']);
        }
    }
}
