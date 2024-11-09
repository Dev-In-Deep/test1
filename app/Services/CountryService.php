<?php

namespace App\Services;

use App\Exceptions\GuestException;
use App\ValueObjects\Country;
use App\ValueObjects\Phone;
use libphonenumber\PhoneNumberUtil;
use Symfony\Component\Intl\Countries;

class CountryService
{
    protected PhoneNumberUtil $phoneUtil;

    public function __construct()
    {
        $this->phoneUtil = PhoneNumberUtil::getInstance();
    }

    public function getCountryName(string $countryCode, string $locale = 'ru'): string
    {
        $countryCode = strtoupper($countryCode);
        $locale = strtolower($locale);

        return Countries::getName($countryCode, $locale) ?: 'Неизвестная страна';
    }

    public function getCountryByPhone(Phone $phone, ?string $defaultRegion = null): Country
    {
        try {
            $numberProto = $this->phoneUtil->parse('+'.$phone->value(), $defaultRegion);

            $countryCode = $numberProto->getCountryCode();

            $regionCodes = $this->phoneUtil->getRegionCodesForCountryCode($countryCode);

            return new Country($regionCodes[0] ?? null);
        } catch (\Throwable) {
            GuestException::extractCountryFromPhone();
        }
    }
}
