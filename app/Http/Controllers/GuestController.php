<?php

namespace App\Http\Controllers;

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
        $newGuest = new Guest;
        $newGuest->fill($data->toArray());
        $newGuest->uuid = Str::uuid();

        $newGuest->save();

        return response()
            ->json()
            ->setStatusCode(201);
    }

    public function show(string $uuid): GuestResource
    {
        $guest = Guest::query()
            ->where('uuid', $uuid)
            ->firstOrFail();

        return new GuestResource($guest, $this->countryService);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
