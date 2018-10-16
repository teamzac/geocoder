<?php

use TeamZac\Geocoder\PlaceSearch;
use TeamZac\Geocoder\GeocodeResult;

class PlaceSearchTest extends PHPUnit\Framework\TestCase
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

        $this->queryLat = 38.8976094;
        $this->queryLng = -77.0367349;
    }

    // /** @test */
    function it_geocodes_an_address()
    {
        $search = new PlaceSearch($this->apiKey);

        $results = $search->search(38.8976094, -77.0367349, 'White House');
        dd($results);
        $this->assertTrue($results instanceof GeocodeResult);

        $this->assertEquals('The White House', $results->name);
        // $this->assertEquals($this->queryLng, $results->getLng());
    }

    // /** @test */
    function it_reverse_geocodes_a_lat_lng_pair()
    {

    }

}