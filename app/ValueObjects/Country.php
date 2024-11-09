<?php

namespace App\ValueObjects;

use Symfony\Component\Intl\Countries;

class Country
{
    protected string $country;

    public function __construct(string $country)
    {
        $country = strtoupper($country);

        if (! Countries::exists($country)) {
            throw new \TypeError('Некорректный код страны');
        }

        $this->country = $country;
    }

    public function value(): string
    {
        return $this->country;
    }
}
