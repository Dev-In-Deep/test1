<?php

use App\ValueObjects\Email;
use Database\Factories\GuestFactory;

use function Pest\Laravel\putJson;

test('Обновить гостя', function () {
    $guest = GuestFactory::new()->create();
    $guest->email = new Email(fake()->email);
    $guestData = GuestFactory::modelToData($guest);

    $answer = putJson(route('guests.update', ['guest' => $guest->uuid]), $guestData);

    expect($answer)
        ->assertStatus(200)
        ->and($answer->json())
        ->email->toBe($guest->email->value());
});

test('Обновить гостя на существующее уникальное поле', function () {
    $guest1 = GuestFactory::new()->create();
    $guest2 = GuestFactory::new()->create();
    $guest1->email = $guest2->email;
    $guestData = GuestFactory::modelToData($guest1);

    $answer = putJson(route('guests.update', ['guest' => $guest1->uuid]), $guestData);

    expect($answer)
        ->assertStatus(409);
});
