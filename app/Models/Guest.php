<?php

namespace App\Models;

use App\Casts\CountryCast;
use App\Casts\EmailCast;
use App\Casts\PhoneCast;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $uuid
 * @property string $first_name
 * @property string $last_name
 * @property \App\ValueObjects\Phone $phone
 * @property \App\ValueObjects\Email $email
 * @property \App\ValueObjects\Country $country
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \App\Models\GuestBuilder<static>|Guest getByPhoneOrEmail(string $phone, string $email)
 * @method static \App\Models\GuestBuilder<static>|Guest getByUuidAndPhoneOrEmail(string $phone, string $email, string $uuid)
 * @method static \App\Models\GuestBuilder<static>|Guest newModelQuery()
 * @method static \App\Models\GuestBuilder<static>|Guest newQuery()
 * @method static \App\Models\GuestBuilder<static>|Guest query()
 * @method static \App\Models\GuestBuilder<static>|Guest whereCountry($value)
 * @method static \App\Models\GuestBuilder<static>|Guest whereCreatedAt($value)
 * @method static \App\Models\GuestBuilder<static>|Guest whereEmail($value)
 * @method static \App\Models\GuestBuilder<static>|Guest whereFirstName($value)
 * @method static \App\Models\GuestBuilder<static>|Guest whereLastName($value)
 * @method static \App\Models\GuestBuilder<static>|Guest wherePhone($value)
 * @method static \App\Models\GuestBuilder<static>|Guest whereUpdatedAt($value)
 * @method static \App\Models\GuestBuilder<static>|Guest whereUuid($value)
 *
 * @mixin \Eloquent
 */
class Guest extends Model
{
    public $incrementing = false;

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'country',
        'country',
    ];

    protected $casts = [
        'phone' => PhoneCast::class,
        'email' => EmailCast::class,
        'country' => CountryCast::class,
    ];

    public function newEloquentBuilder($query): GuestBuilder
    {
        return new GuestBuilder($query);
    }
}
