<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InstrumentBrand extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'brand_name',
        'brand_description',
    ];

    /**
     * Connects the InstrumentBrand model the Instruments Model with HasMany relation
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function instruments(): HasMany
    {
     return $this->hasMany(Instrument::class, 'brand_id');
    }
}
