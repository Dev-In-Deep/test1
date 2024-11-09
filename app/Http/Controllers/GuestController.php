<?php

namespace App\Http\Controllers;

use App\Http\Resources\GuestResource;
use App\Models\Guest;
use App\Services\CountryService;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function __construct(
        protected CountryService $countryService,
    ) {}

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
