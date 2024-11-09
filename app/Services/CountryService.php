<?php

namespace App\Services;
use Symfony\Component\Intl\Countries;

class CountryService
{
    public function getCountryName(string $countryCode, string $locale = 'ru'): string
    {
        $countryCode = strtoupper($countryCode);
        $locale = strtolower($locale);

        return Countries::getName($countryCode, $locale) ?: 'Неизвестная страна';
    }
}
