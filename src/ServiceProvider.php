<?php namespace ALawrence\LaravelAircraftRegistration;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap all application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['validator']->extendDependent('aircraftreg', Validator::class . '@validate');

        // TODO: Register Rules\AircraftRegistration once written.
    }

    /**
     * Register this service provider.
     *
     * @return void
     */
    public function register()
    {
        \App::bind("aircraft-registration", function () {
            return new AircraftRegistration();
        });
    }
}