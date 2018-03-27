<?php namespace ALawrence\LaravelAircraftRegistration;

use Iso3166\Codes as IsoCodes;

class AircraftRegistration
{
    /**
     * @var string|null The provided country.
     */
    protected $countryCode = null;

    /**
     * @var string The provided aircraft registration.
     */
    protected $registration;

    /**
     * @var array array of country codes (ISO 3166 2 letter) to formats.
     */
    protected $formats = [
        "IE" => [
            "EI\-[A-Z]{3}",
            "EJ\-[A-Z]{4}",
        ],
        "GB" => [
            "G\-[A-Z]{4}",
        ],
        "US" => [
            "N\-[1-9][0-9]{0,4}",
            "N\-[1-9][0-9]{1,3}[A-Z]",
            "N\-[1-9][0-9]{1,2}[A-Z][A-Z]",
        ],
    ];

    public function __construct($registration)
    {
        $this->registration = $registration;

        $this->formats = collect($this->formats)->transform(function ($rules) {
            return collect($rules)->transform(function ($rule) {
                return "/^" . $rule . "$/";
            });
        });
    }

    /**
     * Make a new instance of the given aircraft registration.
     *
     * @param string      $registration
     * @param string|null $countryCode
     *
     * @return \ALawrence\LaravelAircraftRegistration\AircraftRegistration
     */
    public static function make($registration, $countryCode = null)
    {
        $instance = new static($registration);

        $instance->setCountryCode($countryCode);

        return $instance;
    }

    /**
     * Set the country code for this registration, from a static method.
     *
     * Will validate to ensure is ISO3166-1 2-char compliant, if not null is set.
     *
     * @param string $countryCode
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = IsoCodes::isValid($countryCode) ? strtoupper($countryCode) : null;
    }

    /**
     * Return the current country code being used.
     *
     * @return null|string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * Return the name of the country based on the code.
     */
    public function getCountry()
    {
        return IsoCodes::country($this->countryCode);
    }

    /**
     * Return the registration for this instance in uppercase.
     *
     * @return string
     */
    public function getRegistration()
    {
        return strtoupper($this->registration);
    }

    /**
     * Convert this instance to a formatted string (the registration in uppercase).
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getRegistration();
    }

    protected function getRules()
    {
        return $this->countryCode !== null ?
            $this->formats->get($this->countryCode, collect()) :
            $this->formats->flatten();
    }

    /**
     * Determine if the current aircraft registration is valid for the provided country.
     *
     * Where $countryCode is null, it'll check all countries.
     *
     * @return bool
     */
    public function isValid()
    {
        foreach ($this->getRules() as $format) {
            if (preg_match($format, $this->getRegistration()) === 1) {
                return true;
            }
        }

        return false;
    }
}