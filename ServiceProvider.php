<?php namespace ALawrence\LaravelAircraftRegistration;

use Illuminate\Support\ServiceProvider;

class ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap all application events.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register this service provider.
     *
     * @return void
     */
    public function register()
    {
        \App::bind("aircraft-registration", function(){
            return new AircraftRegistration();
        });
    }
}