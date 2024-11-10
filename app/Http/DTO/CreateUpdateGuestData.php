<?php

namespace App\Http\DTO;

use App\ValueObjects\Country;
use App\ValueObjects\Email;
use App\ValueObjects\Phone;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithCastable;
use Spatie\LaravelData\Data;

class CreateUpdateGuestData extends Data
{
    #[MapInputName('firstName')]
    public string $first_name;

    #[MapInputName('lastName')]
    public string $last_name;

    #[WithCastable(Email::class)]
    public Email $email;

    #[WithCastable(Phone::class)]
    public Phone $phone;

    #[WithCastable(Country::class)]
    public ?Country $country;
}
