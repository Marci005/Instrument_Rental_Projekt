<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Instrument extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'category_id',
        'brand_id',
        'condition',
        'title',
        'description',
    ];

    /**
     * Connects the Instrument model the InstrumentCategory Model with BelongsTo relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function category(): BelongsTo
    {
        return $this->belongsTo(InstrumentCategory::class, 'category_id');
    }

    /**
     * Connects the Instrument model the InstrumentBrand Model with BelongsTo relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(InstrumentBrand::class, 'brand_id');
    }
}
