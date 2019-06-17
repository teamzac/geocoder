<?php

namespace TeamZac\Geocoder;

use GuzzleHttp\Client;

class PlaceSearch
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
     * Search for places around a lat/lng and radius
     *
     * @param   double $lat
     * @param   double $lng
     * @param   integer $radius (meters)
     * @return this
     */
    public function search($lat, $lng, $keyword = null, $radius = 1000)
    {
        $this->query = [
            'location' => sprintf("%s,%s", $lat, $lng),
            'radius' => $radius
        ];

        if ( $keyword ) {
            $this->query['keyword'] = $keyword;
        }

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
            'base_uri' => 'https://maps.googleapis.com/maps/api/place/nearbysearch/json',
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
        
        return (new GeocodeResult)
            ->setResults(count($json->results) ? $json->results[0] : null);
    }
}
