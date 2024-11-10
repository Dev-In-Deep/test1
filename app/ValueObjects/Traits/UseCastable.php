<?php

namespace App\ValueObjects\Traits;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

/**
 * trait for laravel-data package casts
 */
trait UseCastable
{
    /**
     * @param  array<mixed>  ...$arguments
     */
    public static function dataCastUsing(...$arguments): Cast
    {
        return new class(self::class) implements Cast
        {
            public function __construct(protected string $valueObject) {}

            public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
            {
                return new $this->valueObject($value);
            }
        };
    }
}
