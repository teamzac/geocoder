<?php

namespace TeamZac\Geocoder;

class GeocodeResult
{
    private $result;

    public function setResults($results)
    {
        $this->result = $results;
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
        foreach ($this->result->address_components as $component)
        {
            if ( in_array($key, $component->types))
            {
                return $component->long_name;
            }
        }
    }
}
