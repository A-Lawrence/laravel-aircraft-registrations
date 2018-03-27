<?php

namespace spec\ALawrence\LaravelAircraftRegistration;

use ALawrence\LaravelAircraftRegistration\AircraftRegistration;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AircraftRegistrationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedThrough("make", ["G-ABCD", "GB"]);

        $this->shouldHaveType(AircraftRegistration::class);
    }

    function it_returns_the_registration_in_uppercase()
    {
        $this->beConstructedThrough("make", ["G-ABCD", "GB"]);

        $this->getRegistration()->shouldReturn("G-ABCD");
    }

    function it_returns_the_country_code_in_uppercase()
    {
        $this->beConstructedThrough("make", ["G-ABCD", "gb"]);

        $this->getCountryCode()->shouldReturn("GB");
    }

    function it_returns_null_when_setting_invalid_country_code()
    {
        $this->beConstructedThrough("make", ["G-ABCD", "ZZ"]);

        $this->getCountryCode()->shouldReturn(null);
    }

    function it_returns_country_information_for_a_valid_country_code()
    {
        $this->beConstructedThrough("make", ["G-ABCD", "GB"]);

        $this->getCountry()->shouldReturn("United Kingdom");
    }

    function it_returns_no_country_information_for_an_invalid_country_code()
    {
        $this->beConstructedThrough("make", ["G-ABCD", "ZZ"]);

        $this->getCountry()->shouldReturn(null);
    }

    function it_validates_a_known_country_registration()
    {
        $this->beConstructedThrough("make", ["G-ABCD", "GB"]);

        $this->isValid()->shouldReturn(true);
    }

    function it_fails_validation_for_a_known_country_registration()
    {
        $this->beConstructedThrough("make", ["THIS-IS-NOT-VALID", "GB"]);

        $this->isValid()->shouldReturn(false);
    }

    function it_validates_an_unknown_registration()
    {
        $this->beConstructedThrough("make", ["G-ABCD"]);

        $this->isValid()->shouldReturn(true);
    }

    function it_fails_validation_for_an_unknown_country_registration()
    {
        $this->beConstructedThrough("make", ["THIS-IS-NOT-VALID"]);

        $this->isValid()->shouldReturn(false);
    }
}
