<?php

namespace App\ValueObjects;

class Phone
{
    protected string $phone;

    public function __construct(string $phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (str_starts_with($phone, '8')) {
            $phone = '7'.ltrim($phone, '8');
        }

        if (strlen($phone) !== 11) {
            throw new \TypeError('Невалидный номер телефона');
        }

        $this->phone = $phone;
    }

    public function value(): string
    {
        return $this->phone;
    }
}