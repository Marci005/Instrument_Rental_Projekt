<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rent extends Model
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
        'instrument_id',
        'rent_price',
        'start_date',
        'end_date',
        'real_end_date',
    ];

    /**
     * Attributes that should be cast to native types.
     * These attributes will automatically be cast to the appropriate type by Eloquent.
     * Ensures date fields are returned as correctly (Carbon date) instead of plain strings.
     *
     * @var array<string>
     */

    protected $casts =[

        'start_date' => 'date',
        'end_date' => 'date',
        'real_end_date' => 'date',
    ];

    /**
     * Connects the Rent model to the User model with a BelongsTo relation.
     * One rent belongs to one user.
     *
     * @return BelongsTo
     */

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Connects the Rent model to the Instrument model with a BelongsTo relation.
     * One rent belongs to one user.
     *
     * @return BelongsTo
     */

    public function instrument() : BelongsTo
    {
        return $this->belongsTo(Instrument::class);
    }

}
