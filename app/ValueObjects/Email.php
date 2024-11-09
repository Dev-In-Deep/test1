<?php

namespace App\ValueObjects;

class Email
{
    protected string $email;

    public function __construct(string $email)
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Недопустимый email адрес');
        }
        $this->email = mb_strtolower($email);
    }

    public function value(): string
    {
        return $this->email;
    }
}
