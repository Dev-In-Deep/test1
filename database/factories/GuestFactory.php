<?php

namespace Database\Factories;

use App\Models\Guest;
use App\ValueObjects\Country;
use App\ValueObjects\Email;
use App\ValueObjects\Phone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Guest>
 */
class GuestFactory extends Factory
{
    protected $model = Guest::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => fake()->uuid,
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'phone' => new Phone((string) fake()->numberBetween(7_000_000_00_00, 7_999_999_99_99)),
            'email' => new Email(fake()->email),
            'country' => new Country(fake()->countryCode),
        ];
    }
}
