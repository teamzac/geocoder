<?php

namespace TeamZac\Geocoder;

class GeocodeResult
{
    private $result;

    public static function make($result)
    {
        return (new static)->setResults($result);
    }

    /**
     * Store the API results.
     *
     * @param array $results
     *
     * @return $this
     */
    public function setResults($results)
    {
        $this->result = $results;

        return $this;
    }

    public function getStreetNumber()
    {
        return $this->getValueForKey('street_number');
    }

    public function getRoute()
    {
        return $this->getValueForKey('route');
    }

    public function getLocality()
    {
        return $this->getValueForKey('locality');
    }

    public function getCounty()
    {
        return $this->getValueForKey('administrative_area_level_2');
    }

    public function getState()
    {
        return $this->getValueForKey('administrative_area_level_1');
    }

    public function getCountry()
    {
        return $this->getValueForKey('country');
    }

    public function getPostalCode()
    {
        return $this->getValueForKey('postal_code');
    }

    public function getFormattedAddress()
    {
        return $this->result->formatted_address;
    }

    public function getPlaceId()
    {
        return $this->result->place_id;
    }

    public function getLat()
    {
        return $this->result->geometry->location->lat;
    }

    public function getLng()
    {
        return $this->result->geometry->location->lng;
    }

    private function getValueForKey($key)
    {
        foreach ($this->result->address_components as $component) {
            if (in_array($key, $component->types)) {
                return $component->long_name;
            }
        }
    }

    public function __get($key)
    {
        if (isset($this->result->{$key})) {
            return $this->result->{$key};
        }
    }
}
