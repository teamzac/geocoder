<?php

namespace TeamZac\Geocoder\Console;

use TeamZac\Geocoder\Geocoder;
use Illuminate\Console\Command;

class ReverseGeocode extends Command 
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'geocoder:reverse-geocode {latlng : <lat>,<lng>}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find the address from a lat lng pair';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        list($lat, $lng) = explode(',', $this->argument('latlng'));

        $result = app(Geocoder::class)->reverseGeocode( $lat, $lng );

        $this->info('Geocoding Results for Lat/Lng: ' . $lat .'/'. $lng);
        $this->info('Address: ' . $result->getFormattedAddress());
    }
}