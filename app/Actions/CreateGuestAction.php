<?php

namespace App\Actions;

use App\Exceptions\GuestException;
use App\Http\DTO\CreateUpdateGuestData;
use App\Models\Guest;
use App\Services\CountryService;

class CreateGuestAction
{
    public function __construct(
        protected CountryService $countryService,
    ) {}

    public function __invoke(CreateUpdateGuestData $data, string $uuid): Guest
    {
        $this->setCountryIfNotExist($data);
        $this->checkExistGuest($data, $uuid);

        return $this->saveGuest($data, $uuid);
    }

    protected function setCountryIfNotExist(CreateUpdateGuestData $data): void
    {
        if (is_null($data->country)) {
            $data->country = $this->countryService->getCountryByPhone($data->phone);
        }
    }

    protected function checkExistGuest(CreateUpdateGuestData $data, string $uuid): void
    {
        $existingGuest = Guest::query()->getByPhoneOrEmail(
            $data->phone->value(),
            $data->email->value()
        );

        if (! is_null($existingGuest)) {
            GuestException::guestExist();
        }
    }

    protected function saveGuest(CreateUpdateGuestData $data, string $uuid): Guest
    {
        $newGuest = new Guest;
        $newGuest->uuid = $uuid;
        $newGuest->fill($data->toArray());
        $newGuest->save();

        return $newGuest;
    }
}
