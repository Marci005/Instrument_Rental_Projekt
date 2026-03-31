<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class InstrumentCategory extends Model
{

    /**
     * Attributes that can be filled by the user.
     * These fields can be filled using create() or fill() methods.
     * Prevents mass assignment vulnerabilities by whitelisting safe fields.
     *
     * @var array<string>
     */

    protected $fillable = [
        'category_name',
        'category_description',
    ];

    /**
     * Connects the InstrumentCategory model to the Instruments model with a HasMany relation.
     * One category can have many instruments.
     *
     * @return HasMany
     */

    public function instruments(): HasMany
    {
        return $this->hasMany(Instrument::class, 'category_id');
    }

}
