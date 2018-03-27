<?php namespace ALawrence\LaravelAircraftRegistration;

class Validator
{
    public function __construct()
    {
        //
    }

    /**
     * Perform validation on a given aircraft registration.
     *
     * @param string $attribute
     * @param mixed  $value
     * @param array  $parameters
     * @param object $validator
     *
     * @return bool
     */
    public function validate($attribute, $value, array $parameters, $validator)
    {
        foreach ($this->extractCountries($parameters) as $country) {
            if(AircraftRegistration::make($value, $country)->isValid()){
                return true;
            }
        }

        return false;
    }

    /**
     * Extract only countries from the given parameters.
     *
     * @param array $parameters
     *
     * @return \Tightenco\Collect\Support\Collection
     */
    private function extractCountries(array $parameters)
    {
        return collect($parameters)->map(function ($countryCode) {
            return strtoupper($countryCode);
        })->filter(function ($countryCode) {
            return \Iso3166\Codes::isValid($countryCode);
        });
    }
}