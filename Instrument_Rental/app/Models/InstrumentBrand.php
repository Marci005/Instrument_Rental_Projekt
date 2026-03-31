<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InstrumentBrand extends Model
{
    /**
     * Attributes that can be filled by the user.
     * These fields can be filled using create() or fill() methods.
     * Prevents mass assignment vulnerabilities by whitelisting safe fields.
     *
     * @var array<string>
     */

    protected $fillable = [
        'brand_name',
        'brand_description',
    ];

    /**
     * Connects the InstrumentBrand model to the Instruments model with a HasMany relation.
     * One brand can have many instruments.
     *
     * @return HasMany
     */

    public function instruments(): HasMany
    {
     return $this->hasMany(Instrument::class, 'brand_id');
    }
}
