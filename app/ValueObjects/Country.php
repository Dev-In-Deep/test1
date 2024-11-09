<?php

namespace App\ValueObjects;

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
            throw new \TypeError('Некорректный код страны');
        }

        $this->country = $country;
    }

    public function value(): string
    {
        return $this->country;
    }
}
