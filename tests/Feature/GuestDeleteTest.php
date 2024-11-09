<?php

use Database\Factories\GuestFactory;

use function Pest\Laravel\deleteJson;

it('Удаление гостя', function () {
    $guest = GuestFactory::new()->create();

    $answer = deleteJson(route('guests.destroy', ['guest' => $guest->uuid]));

    $answer->assertStatus(204);
});

it('Удаление несуществующего гостя', function () {
    $answer = deleteJson(route('guests.destroy', ['guest' => fake()->uuid()]));

    $answer->assertStatus(404);
});
