<?php

namespace TeamZac\Geocoder;

class GeocodingQuery
{
    /** @var array */
    protected $params;

    /** @var string */
    protected $apiKey;

    public static function geocode($address, $apiKey)
    {
        return new static([
            'address' => $address,
        ], $apiKey);
    }

    public static function reverseGeocode($lat, $lng, $apiKey)
    {
        return new static([
            'latlng' => "{$lat},{$lng}",
        ], $apiKey);
    }

    /**
     * @var array
     * @var string $apiKey
     */
    public function __construct(array $params, string $apiKey)
    {
        $this->params = $params;
        $this->apiKey = $apiKey;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function toArray()
    {
        return array_merge($this->params, ['key' => $this->apiKey]);
    }
}
