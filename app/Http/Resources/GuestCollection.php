<?php

namespace App\Http\Resources;

use App\Services\CountryService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GuestCollection extends ResourceCollection
{
    public function __construct($resource, protected CountryService $countryService)
    {
        parent::__construct($resource);
    }

    protected function collectResource($resource): void
    {
        $this->collection = $resource->map(fn ($value, $key) => new GuestResource($value, $this->countryService));
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(fn ($value, $key) => $value->toArray($request))->all();
    }
}
