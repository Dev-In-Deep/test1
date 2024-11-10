<?php

namespace App\Actions;

use App\Exceptions\GuestException;
use App\Http\DTO\CreateUpdateGuestData;
use App\Models\Guest;

class UpdateGuestAction extends CreateGuestAction
{
    protected function checkExistGuest(CreateUpdateGuestData $data, string $uuid): void
    {
        $existingGuest = Guest::query()->getByUuidAndPhoneOrEmail(
            $data->phone->value(),
            $data->email->value(),
            $uuid,
        );

        if (! is_null($existingGuest)) {
            GuestException::guestExist();
        }
    }

    protected function saveGuest(CreateUpdateGuestData $data, string $uuid): Guest
    {
        $guest = Guest::query()->findOrFail($uuid);
        $guest->fill($data->toArray());
        $guest->save();

        return $guest;
    }
}
