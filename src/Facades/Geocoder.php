<?php

namespace TeamZac\Geocoder\Facades;

use TeamZac\Geocoder\Geocoder;
use Illuminate\Support\Facades\Facade;

class Geocoder extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return Geocoder::class; }
}