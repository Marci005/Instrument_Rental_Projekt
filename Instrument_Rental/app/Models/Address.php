<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Address extends Model
{

    /**
     * Attributes that can be filled by the user.
     * These fields can be filled using create() or fill() methods.
     * Prevents mass assignment vulnerabilities by whitelisting safe fields.
     *
     * @var array<string>
     */

    protected $fillable = [
        'user_id',
        'country',
        'zip',
        'street',
        'house_number',
        'address_type',
        'settlement',
        'floor_number',
        'door_number',
    ];

    /**
     * Connects the Address model to the User model with a BelongsTo relation.
     * One address belongs to one user.
     *
     * @return BelongsTo
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
