# A lightweight wrapper around the Google Maps geocoding service

[![Latest Version on Packagist](https://img.shields.io/packagist/v/teamzac/geocoder.svg?style=flat-square)](https://packagist.org/packages/teamzac/geocoder)

## Installation

You can install the package via composer:

```bash
composer require teamzac/geocoder
```

## Usage

This package uses Laravel's autodiscovery feature, so you do not have to manually add the service provider.

You can publish the config file if you'd like, or simply add the following to your .env file:

```php
GOOGLE_MAPS_API_KEY={{YOUR API KEY HERE}}
```

The ```TeamZac\Geocoder\Geocoder``` class can be resolved from the container, or you can use the facade. There are two primary methods on this class:

```php
// get lat/lng from an address
Geocoder::geocode('1600 Pennsvylvania Ave, Washington DC 20500');

// get an address from lat/lng pair
Geocoder::reverseGeocode(38.8976633, -77.036573);
```

Both methods will return an instance of ```TeamZac\Geocoder\GeocodeResult```, or throw an exception if no results were found.

The ```GeocodeResult``` class is a simple data transfer object that makes it more convenience to access information about the response. 

```php
$result = Geocoder::geocode('123 main street anywhere USA');

$result->getState();
$result->getLocality();
$result->getStreetNumber();
```

For a full list of available methods, just check out the class' implementation.


### Testing

``` bash
composer test
```

You'll want to copy the ```.env.example``` file as ```.env.testing.php``` and add your Google Maps API key to enable testing.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email chad@zactax.com instead of using the issue tracker.

## Credits

- [Laravel Package Boilerplate](https://laravelpackageboilerplate.com)
