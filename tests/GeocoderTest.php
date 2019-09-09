<?php

namespace TeamZac\Geocoder\Test;

use TeamZac\Geocoder\Geocoder;
use TeamZac\Geocoder\GeocodeResult;
use TeamZac\Geocoder\Exceptions\NoGeocodingResultReturned;

class GeocoderTest extends TestCase
{
    protected $apiKey;

    protected $queryAddress;

    protected $queryLat;

    protected $queryLng;

    public function setUp(): void
    {
        parent::setUp();

        $this->geocoder = new Geocoder($this->app['config']['geocoder.google_maps_api_key']);

        $this->queryAddress = '1600 Pennsylvania Avenue, Washington, DC 20500';

        $this->queryLat = 38.8976633;
        $this->queryLng = -77.0365739;
    }

    /** @test */
    public function it_geocodes_an_address()
    {
        $results = $this->geocoder->geocode($this->queryAddress);

        $this->assertTrue($results instanceof GeocodeResult);

        $this->assertEquals($this->queryLat, $results->getLat());
        $this->assertEquals($this->queryLng, $results->getLng());
    }

    /** @test */
    public function it_reverse_geocodes_a_lat_lng_pair()
    {
        $results = $this->geocoder->reverseGeocode($this->queryLat, $this->queryLng);

        $this->assertTrue($results instanceof GeocodeResult);

        $this->assertEquals($this->queryLat, $results->getLat());
        $this->assertEquals($this->queryLng, $results->getLng());
    }

    /** @test */
    public function an_exception_is_thrown_when_no_results_are_returned()
    {
        $invalidAddress = '100 Does Not Exist, Nowhere, XY 12345';

        try {
            $results = $this->geocoder->geocode($invalidAddress);
        } catch (NoGeocodingResultReturned $e) {
            $this->assertSame($invalidAddress, $e->getParams()['address']);
            return;
        }
        $this->fail('No exception was thrown, even though no results were returned');
    }
}
