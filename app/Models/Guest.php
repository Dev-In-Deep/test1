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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guest whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guest whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guest whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guest whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guest wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guest whereUuid($value)
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
}
