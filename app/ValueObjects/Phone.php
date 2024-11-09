<?php

namespace App\ValueObjects;

use App\Exceptions\ValueException;
use App\ValueObjects\Traits\UseCastable;
use Spatie\LaravelData\Casts\Castable;

class Phone implements Castable
{
    use UseCastable;

    protected string $phone;

    public function __construct(string $phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (str_starts_with($phone, '8')) {
            $phone = '7'.ltrim($phone, '8');
        }

        if (strlen($phone) !== 11) {
            ValueException::incorrectPhone();
        }

        $this->phone = $phone;
    }

    public function value(): string
    {
        return $this->phone;
    }
}
