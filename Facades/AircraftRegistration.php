<?php namespace ALawrence\LaravelAircraftRegistration\Facades;

use Illuminate\Support\Facades\Facade;

class AircraftRegistration extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return "aircraft-registration";
    }
}