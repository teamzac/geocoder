<?php

namespace TeamZac\Geocoder;

use GuzzleHttp\Client;
use TeamZac\Geocoder\Exceptions\NoGeocodingResultReturned;

class Geocoder
{
    /** @var string */
    protected $apiKey;

    /** @var GeocodingQuery */
    private $query;

    /**
     * Construct the object.
     *
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
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
        $this->query = GeocodingQuery::geocode($address, $this->apiKey);

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
        $this->query = GeocodingQuery::reverseGeocode($lat, $lng, $this->apiKey);

        return $this->getResults();
    }

    /**
     * Query the geocoding service (Google).
     *
     * @return GeocodingResult
     */
    protected function getResults()
    {
        $apiResponse = $this->performQuery();

        if (! isset($apiResponse->results) || count($apiResponse->results) == 0) {
            throw NoGeocodingResultReturned::forQueryParams($this->query->getParams());
        }

        return GeocodeResult::make($apiResponse->results[0]);
    }

    /**
     * Query the API service.
     *
     * @return  JSON parsed object
     *
     * @throws  Exception
     */
    protected function performQuery()
    {
        $response = $this->http()->get('', [
            'headers' => [
                'Accept'     => 'application/json',
            ],
            'query' => $this->query->toArray(),
        ]);

        if ($response->getStatusCode() >= 400) {
            throw new \Exception('Unable to process Geocoding');
        }

        return json_decode($response->getBody());
    }

    /**
     * Create the HTTP client.
     *
     * @return  GuzzleHttp\Client
     */
    protected function http()
    {
        return new Client([
            'base_uri'  => 'https://maps.googleapis.com/maps/api/geocode/json',
            'timeout'   => 10.0,
            'stream'    => false,
        ]);
    }
}
