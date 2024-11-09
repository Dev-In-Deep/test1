<?php

namespace App\ValueObjects;

use App\Exceptions\ValueException;
use App\ValueObjects\Traits\UseCastable;
use Spatie\LaravelData\Casts\Castable;

class Email implements Castable
{
    use UseCastable;

    protected string $email;

    public function __construct(string $email)
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            ValueException::incorrectEmail();
        }

        $this->email = mb_strtolower($email);
    }

    public function value(): string
    {
        return $this->email;
    }
}
