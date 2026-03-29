<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
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
     * The attributes that should be cast to native types.
     *
     * These attributes will automatically be cast to the appropriate type by Eloquent
     *
     * @var array<string>
     */

    protected $casts =[

        'start_date' => 'date',
        'end_date' => 'date',
        'real_end_date' => 'date',
    ];


    /**
     * Connects the Rent model the User Model with belongsTo relation
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Connects the Rent model the Instrument Model with HasMany relation
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instrument() : BelongsTo
    {
        return $this->belongsTo(Instrument::class);
    }

}
