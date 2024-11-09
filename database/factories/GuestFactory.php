<?php

namespace Database\Factories;

use App\Models\Guest;
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
            'phone' => (string) fake()->numberBetween(7_000_000_00_0, 7_999_999_999_9),
            'email' => fake()->email,
            'country' => fake()->countryCode,
        ];
    }
}
