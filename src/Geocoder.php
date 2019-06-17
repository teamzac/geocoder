<?php

namespace TeamZac\Geocoder;

use GuzzleHttp\Client;

class Geocoder
{
    /** @var string */
    protected $apiKey;

    /** @var array */
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
     * @param string $address
     * @return this
     */
    public function geocode($address='')
    {
        $this->query = [
            'address' => $address,
            'key' => $this->apiKey,
        ];
        return $this->getResults();
    }

    /**
     * Reverse geocode given the latitude/longitude pair
     *
     * @param   double $lat
     * @param   double $lng
     * @return  this
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
     * @return GeocodingResult
     */
    protected function getResults()
    {
        $apiResponse = $this->performQuery();
        
        return (new GeocodeResult)
            ->setResults(count($apiResponse->results) ? $apiResponse->results[0] : null);
    }

    /**
     * Query the API service
     * 
     * @return  JSON parsed object
     * @throws  Exception
     */
    protected function performQuery()
    {
        $response = $this->http()->get('', [
            'headers' => [
                'Accept'     => 'application/json',
            ],
            'query' => $this->query,
        ]);

        if ( $response->getStatusCode() >= 400 ) {
            throw new \Exception('Unable to process Geocoding');
        }

        return json_decode($response->getBody());;
    }

    /**
     * Create the HTTP client
     * 
     * @return  GuzzleHttp\Client
     */
    protected function http()
    {
        return new Client([
            'base_uri' => 'https://maps.googleapis.com/maps/api/geocode/json',
            'timeout'  => 10.0,
            'stream' => false,
        ]);
    }
}
