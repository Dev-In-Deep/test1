<?php

namespace App\Http\Controllers;

use App\Exceptions\GuestException;
use App\Http\DTO\CreateGuestData;
use App\Http\Resources\GuestResource;
use App\Models\Guest;
use App\Services\CountryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    public function __construct(
        protected CountryService $countryService,
    ) {}

    public function index()
    {
        //
    }

    public function store(CreateGuestData $data): JsonResponse
    {
        if (is_null($data->country)) {
            $data->country = $this->countryService->getCountryByPhone($data->phone);
        }

        $existingGuest = Guest::query()
            ->where('phone', $data->phone->value())
            ->orWhere('email', $data->email->value())
            ->first();

        if (! is_null($existingGuest)) {
            GuestException::guestExist();
        }

        $newGuest = new Guest;
        $newGuest->fill($data->toArray());
        $newGuest->uuid = Str::uuid();
        $newGuest->save();

        return $this->resourceResponse($newGuest, 201);
    }

    public function show(string $uuid): JsonResponse
    {
        $guest = Guest::query()
            ->where('uuid', $uuid)
            ->firstOrFail();

        return $this->resourceResponse($guest);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    protected function resourceResponse(Guest $guest, int $code = 200): JsonResponse
    {
        return response()
            ->json(new GuestResource($guest, $this->countryService))
            ->setStatusCode($code);
    }
}
