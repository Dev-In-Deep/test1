<?php

namespace App\Exceptions;

class GuestException extends BusinessException
{
    public static function extractCountryFromPhone(): void
    {
        throw new GuestException('Не удалось получить страну', code: 422);
    }

    public static function guestExist(): void
    {
        throw new GuestException('Такой гость уже существует', code: 409);
    }
}
