<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class InstrumentCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'category_name',
        'category_description',
    ];

    /**
     * Connects the InstrumentCategory model the Instruments Model with HasMany relation
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instruments(): HasMany
    {
        return $this->hasMany(Instrument::class, 'category_id');
    }

}
