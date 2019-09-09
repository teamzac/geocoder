<?php

namespace TeamZac\Geocoder\Exceptions;

class NoGeocodingResultReturned extends \Exception
{
    /** @var array */
    protected $params;

    public static function forQueryParams($params)
    {
        return (new static)->setParams($params);
    }

    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    public function getParams()
    {
        return $this->params;
    }
}
