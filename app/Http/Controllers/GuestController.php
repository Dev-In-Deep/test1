<?php

namespace App\Http\Controllers;

use App\Actions\CreateGuestAction;
use App\Actions\UpdateGuestAction;
use App\Http\DTO\CreateUpdateGuestData;
use App\Http\Resources\GuestCollection;
use App\Http\Resources\GuestResource;
use App\Models\Guest;
use App\Services\CountryService;
use Database\Factories\GuestFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    public function __construct(
        protected CountryService $countryService,
    ) {}

    public function index(): GuestCollection
    {
        return new GuestCollection(Guest::all(), $this->countryService);
    }

    public function show(string $uuid): JsonResponse
    {
        $guest = Guest::query()->findOrFail($uuid);

        return $this->resourceResponse($guest);
    }

    public function store(CreateUpdateGuestData $data, CreateGuestAction $action): JsonResponse
    {
        return $this->resourceResponse($action($data, Str::uuid()), 201);
    }

    public function update(CreateUpdateGuestData $data, string $uuid, UpdateGuestAction $action): JsonResponse
    {
        return $this->resourceResponse($action($data, $uuid));
    }

    public function destroy(string $uuid): JsonResponse
    {
        $guest = Guest::query()->findOrFail($uuid);

        $guest->delete();

        return response()->json([], 204);
    }

    protected function resourceResponse(Guest $guest, int $code = 200): JsonResponse
    {
        return response()
            ->json(new GuestResource($guest, $this->countryService))
            ->setStatusCode($code);
    }
}
