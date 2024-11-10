<?php

namespace App\Exceptions;

class ValueException extends BusinessException
{
    public static function incorrectCountryCode(): void
    {
        throw new ValueException('Некорректный код страны', code: 422);
    }

    public static function incorrectEmail(): void
    {
        throw new ValueException('Недопустимый email адрес', code: 422);
    }

    public static function incorrectPhone(): void
    {
        throw new ValueException('Невалидный номер телефона', code: 422);
    }
}
