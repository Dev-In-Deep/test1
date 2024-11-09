<?php

namespace Tests\Feature;

use Database\Factories\GuestFactory;
use function Pest\Laravel\getJson;

it("Получение гостя", function () {
    $guest = GuestFactory::new()
        ->state(["country" => "ru"])
        ->create();

    $answer = getJson(route("guests.show"), ["guest" => $guest->id]);

    $answer->assertOk()
        ->assertJsonStructure([
            "id" => $guest->id,
            "firstName" => $guest->first_name,
            "lastName" => $guest->last_name,
            "email" => $guest->email,
            "phone" => $guest->phone,
            "country" => "Россия",
        ]);
});
