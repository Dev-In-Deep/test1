<?php

namespace Tests\Feature;

use Database\Factories\GuestFactory;
use function Pest\Laravel\getJson;

it("Получение гостя", function (string $countryCode, string $countryName) {
    $guest = GuestFactory::new()
        ->state(["country" => $countryCode])
        ->create();

    $answer = getJson(route("guests.show", ["guest" => $guest->uuid]));

    $answer->assertOk()
        ->assertJson([
            "uuid" => $guest->uuid,
            "firstName" => $guest->first_name,
            "lastName" => $guest->last_name,
            "email" => $guest->email,
            "phone" => $guest->phone,
            "country" => $countryName,
        ]);
})->with([
    ["ru", "Россия"],
    ["fr", "Франция"],
]);
