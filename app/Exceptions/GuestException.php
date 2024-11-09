<?php

namespace App\Exceptions;

class GuestException extends BusinessException
{
    public static function extractCountryFromPhone()
    {
        throw new GuestException('Не удалось получить страну', code: 422);
    }

    public static function guestExist()
    {
        throw new GuestException('Такой гость уже существует', code: 409);
    }
}
