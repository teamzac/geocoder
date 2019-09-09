<?php

namespace TeamZac\Geocoder;

use Illuminate\Support\Str;

class FakeGeocoder
{
    /** @var array */
    protected $response;

    /**
     * Create a fake geocoder, optionally providing a default response to return.
     *
     * @param array $fakeResponse
     */
    public function __construct($fakeResponse = [])
    {
        $this->setFakeResponse($fakeResponse);
    }

    /**
     * Geocode the given address.
     *
     * @param string $address
     *
     * @return this
     */
    public function geocode($address = '')
    {
        return $this->getResults();
    }

    /**
     * Reverse geocode given the latitude/longitude pair.
     *
     * @param   float $lat
     * @param   float $lng
     *
     * @return  this
     */
    public function reverseGeocode($lat, $lng)
    {
        return $this->getResults();
    }

    protected function getResults()
    {
        return GeocodeResult::make(json_decode(json_encode($this->response)));
    }

    /**
     * Prepare a fake response.
     *
     * @param  array $overrides
     */
    protected function setFakeResponse($overrides = [])
    {
        $this->response = array_merge([
            'address_components' => [
                [
                    'long_name' => '123',
                    'types'     => ['street_number'],
                ],
                [
                    'long_name' => 'Main Street',
                    'types'     => ['route'],
                ],
                [
                    'long_name' => 'Anywhere',
                    'types'     => ['locality'],
                ],
                [
                    'long_name' => 'Somewhere County',
                    'types'     => ['administrative_area_level_2'],
                ],
                [
                    'long_name'     => 'Texas',
                    'short_name'    => 'TX',
                    'types'         => ['administrative_area_level_1'],
                ],
                [
                    'long_name'     => 'United States',
                    'short_name'    => 'US',
                    'types'         => ['country'],
                ],
                [
                    'long_name' => '77777',
                    'types'     => ['postal_code'],
                ],
            ],
            'formatted_address' => '123 Main Street, Anywhere, TX 77777 USA',
            'geometry'          => [
                'location' => [
                    'lat' => 32.000,
                    'lng' => -97.000,
                ],
            ],
            'place_id' => Str::random(20),
        ], $overrides);
    }
}
