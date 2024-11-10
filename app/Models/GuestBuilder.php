<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @extends Builder<Guest>
 */
class GuestBuilder extends Builder
{
    public function getByPhoneOrEmail(string $phone, string $email): ?Guest
    {
        return $this
            ->where('phone', $phone)
            ->orWhere('email', $email)
            ->first();
    }

    public function getByUuidAndPhoneOrEmail(string $phone, string $email, string $uuid): ?Guest
    {
        return $this
            ->whereNot('uuid', $uuid)
            ->where(function ($query) use ($phone, $email) {
                $query
                    ->where('phone', $phone)
                    ->orWhere('email', $email);
            })
            ->first();
    }
}
