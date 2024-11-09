<?php

use Database\Factories\GuestFactory;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\postJson;

test('Добавить гостя', function () {
    $guestData = GuestFactory::new()->toCreate();

    postJson(route('guests.store'), $guestData)
        ->assertCreated();

    assertDatabaseCount('guests', 1);
});
