<?php

namespace TeamZac\Geocoder;

use GuzzleHttp\Client;

class Geocoder
{
    protected $apiKey;

    private $query;

    /**
     * Construct the object
     *
     * @param   string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Geocode the given address
     *
     * @param string $adress
     * @return this
     */
    public function geocode($address='')
    {
        $this->query = [
            'address' => $address
        ];
        return $this->getResults();
    }

    /**
     * Reverse geocode given the latitude/longitude pair
     *
     * @param type var Description
     * @return this
     */
    public function reverseGeocode($lat, $lng)
    {
        $this->query = [
            'latlng' => "{$lat},{$lng}",
            'key' => $this->apiKey
        ];
        return $this->getResults();
    }

    /**
     * Query the geocoding service (Google)
     *
     * @param 
     * @return GeocodingResult
     */
    private function getResults()
    {
        $client = new Client([
            'base_uri' => 'https://maps.googleapis.com/maps/api/geocode/json',
            'timeout'  => 10.0,
            'stream' => false,
        ]);

        $queryString =  http_build_query($this->query);

        $response = $client->get('', [
            'headers' => [
                'Accept'     => 'application/json',
            ],
            'query' => $this->query,
        ]);

        if ( $response->getStatusCode() >= 400 )
        {
            throw new \Exception('Unable to process Geocoding');
        }

        $json = json_decode($response->getBody());
        
        $geocodingResult = new GeocodeResult;
        $geocodingResult->setResults( count($json->results) ? $json->results[0] : null );
        return $geocodingResult;
    }
}