<?php

namespace TeamZac\Geocoder\Console;

use TeamZac\Geocoder\Geocoder;
use Illuminate\Console\Command;

class Geocode extends Command 
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'geocoder:geocode {address}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Geocode a given address';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $result = app(Geocoder::class)->geocode($this->argument('address'));

        $this->info('Geocoding Results for Query: '.$this->argument('address'));
        $this->info('Lat: '.$result->getLat());
        $this->info('Lng: '.$result->getLng());
    }
}