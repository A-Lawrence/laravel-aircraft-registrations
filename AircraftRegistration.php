<?php namespace ALawrence\LaravelAircraftRegistration;


class AircraftRegistration
{
    /**
     * @var array array of country codes (ISO 3166 2 letter) to formats.
     */
    protected $formats = [
        "IE" => [
            "^EI\-[A-Z]{3}$",
            "^EJ\-[A-Z]{4}$",
        ],
        "GB" => [
            "^G\-[A-Z]{4}$",
        ],
        "US" => [
            "^N\-[1-9][0-9]{0,4}$",
            "^N\-[1-9][0-9]{1,3}[A-Z]$",
            "^N\-[1-9][0-9]{1,2}[A-Z][A-Z]$",
        ],
    ];

    public function __construct()
    {
        //
    }


}