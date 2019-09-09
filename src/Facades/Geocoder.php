<?php

namespace TeamZac\Geocoder\Facades;

use TeamZac\Geocoder\FakeGeocoder;
use Illuminate\Support\Facades\Facade;
use TeamZac\Geocoder\Geocoder as ConcreteGeocoder;

class Geocoder extends Facade
{
    /**
     * Replace the bound instance with a fake.
     *
     * @return TeamZac\Geocoder\FakeGeocoder
     */
    public static function fake($fakeResponse = [])
    {
        static::swap($fake = new FakeGeocoder($fakeResponse));

        return $fake;
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ConcreteGeocoder::class;
    }
}
