<?php

use TeamZac\Geocoder\Geocoder;
use TeamZac\Geocoder\GeocodeResult;

class GeocoderTest extends PHPUnit\Framework\TestCase
{
    protected $apiKey;

    protected $queryAddress;

    protected $queryLat;

    protected $queryLng;

    function setUp()
    {
        $env = require( dirname(__DIR__) . '/.env');
        $this->apiKey = $env['apiKey'];

        $this->queryAddress = '1600 Pennsylvania Avenue, Washington, DC 20500';

        $this->queryLat = 38.8976633;
        $this->queryLng = -77.0365739;
    }

    /** @test */
    function it_geocodes_an_address()
    {
        $geocoder = new Geocoder($this->apiKey);

        $results = $geocoder->geocode($this->queryAddress);

        $this->assertTrue($results instanceof GeocodeResult);

        $this->assertEquals($this->queryLat, $results->getLat());
        $this->assertEquals($this->queryLng, $results->getLng());
    }

    /** @test */
    function it_reverse_geocodes_a_lat_lng_pair()
    {
        $geocoder = new Geocoder($this->apiKey);

        $results = $geocoder->reverseGeocode($this->queryLat, $this->queryLng);

        $this->assertTrue($results instanceof GeocodeResult);

        $this->assertEquals($this->queryLat, $results->getLat());
        $this->assertEquals($this->queryLng, $results->getLng());
    }

}