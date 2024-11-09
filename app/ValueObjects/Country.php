<?php

namespace App\ValueObjects;

use App\Exceptions\ValueException;
use App\ValueObjects\Traits\UseCastable;
use Spatie\LaravelData\Casts\Castable;
use Symfony\Component\Intl\Countries;

class Country implements Castable
{
    use UseCastable;

    protected string $country;

    public function __construct(string $country)
    {
        $country = strtoupper($country);

        if (! Countries::exists($country)) {
            ValueException::incorrectCountryCode();
        }

        $this->country = $country;
    }

    public function value(): string
    {
        return $this->country;
    }
}
