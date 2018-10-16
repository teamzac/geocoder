<?php

namespace TeamZac\Geocoder;

use GuzzleHttp\Client;

class PlaceDetails
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
     * Get the details of the place ID
     * 
     * @param string $placeId
     * @return this
     */
    public function getDetails($placeId)
    {
        $this->query = [
            'placeid' => $placeId
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
            'base_uri' => 'https://maps.googleapis.com/maps/api/place/details/json',
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
            throw new \Exception('Unable to get place details');
        }

        $json = json_decode($response->getBody());
        
        $geocodingResult = new GeocodeResult;
        $geocodingResult->setResults( count($json->results) ? $json->results[0] : null );
        return $geocodingResult;
    }
}