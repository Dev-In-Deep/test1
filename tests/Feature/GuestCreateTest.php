<?php

use Database\Factories\GuestFactory;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\postJson;

test('Добавить гостя', function (array $guestData) {
    postJson(route('guests.store'), $guestData)
        ->assertCreated();

    assertDatabaseCount('guests', 1);
})->with([
    [GuestFactory::new()->toCreate()],
    [GuestFactory::new()->toCreate(true)],
]);

test('Добавить гостя существующего гостя', function (array $fields, int $code) {

    $existGuest = GuestFactory::new()->create();
    $guestData = GuestFactory::new()->toCreate();

    foreach ($fields as $field) {
        $guestData[$field] = $existGuest->{$field}->value();
    }

    postJson(route('guests.store'), $guestData)
        ->assertStatus($code);

})->with([
    [['email'], 409],
    [['phone'], 409],
    [['phone', 'email'], 409],
    [[], 201],
]);
