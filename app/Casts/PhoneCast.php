<?php

namespace App\Casts;

use App\ValueObjects\Phone;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

/**
 * @implements CastsAttributes<Phone, Phone>
 */
class PhoneCast implements CastsAttributes
{
    public bool $withoutObjectCaching = true;

    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): Phone
    {
        return new Phone($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        return $value->value();
    }
}
