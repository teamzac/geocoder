<?php

namespace TeamZac\Geocoder\Test;

use TeamZac\Geocoder\Facades\Geocoder;

class FakeGeocoderTest extends TestCase
{
    /** @test */
    public function it_returns_a_generic_fake_response()
    {
        Geocoder::fake();

        $result = Geocoder::geocode('Random address');

        $this->assertSame('123 Main Street, Anywhere, TX 77777 USA', $result->getFormattedAddress());
    }

    /** @test */
    public function the_generic_response_can_be_overwritten()
    {
        Geocoder::fake([
            'formatted_address' => 'My custom address',
        ]);

        $result = Geocoder::geocode('Random address');

        $this->assertSame('My custom address', $result->getFormattedAddress());
    }
}
