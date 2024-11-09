<?php

namespace App\Http\Resources;

use App\Models\Guest;
use App\Services\CountryService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Guest
 */
class GuestResource extends JsonResource
{
    public function __construct($resource, protected CountryService $countryService)
    {
        parent::__construct($resource);
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'email' => $this->email->value(),
            'phone' => $this->phone->value(),
            'country' => $this->countryService->getCountryName($this->country->value()),
        ];
    }
}
