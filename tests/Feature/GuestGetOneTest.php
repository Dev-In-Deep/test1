<?php

namespace Tests\Feature;

use App\ValueObjects\Country;
use Database\Factories\GuestFactory;

use function Pest\Laravel\getJson;

it('Получение гостя', function (string $countryCode, string $countryName) {
    $guest = GuestFactory::new()
        ->state(['country' => new Country($countryCode)])
        ->create();

    $answer = getJson(route('guests.show', ['guest' => $guest->uuid]));

    $answer->assertOk()
        ->assertJson([
            'uuid' => $guest->uuid,
            'firstName' => $guest->first_name,
            'lastName' => $guest->last_name,
            'email' => $guest->email->value(),
            'phone' => $guest->phone->value(),
            'country' => $countryName,
        ]);
})->with([
    ['ru', 'Россия'],
    ['fr', 'Франция'],
]);

it('Гость не найден', function () {
    $uuid = fake()->uuid;

    $answer = getJson(route('guests.show', ['guest' => $uuid]));

    $answer->assertNotFound();
});
