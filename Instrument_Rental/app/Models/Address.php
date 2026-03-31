<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
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
     * Connects this model to the User model's user_id
     *
     * @return
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
