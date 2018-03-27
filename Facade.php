<?php namespace ALawrence\LaravelAircraftRegistration\Facades;

use Illuminate\Support\Facades\Facade;

class Facade extends Facade {
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