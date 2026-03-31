<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Instrument extends Model
{
    /**
     * Attributes that can be filled by the user.
     * These fields can be filled using create() or fill() methods.
     * Prevents mass assignment vulnerabilities by whitelisting safe fields.
     *
     * @var array<string>
     */

    protected $fillable = [
        'category_id',
        'brand_id',
        'condition',
        'title',
        'description',
    ];

    /**
     * Connects the Instrument model to the InstrumentCategory model with a BelongsTo relation.
     * One instrument belongs to one category.
     *
     * @return BelongsTo
     */

    public function category(): BelongsTo
    {
        return $this->belongsTo(InstrumentCategory::class, 'category_id');
    }

    /**
     * Connects the Instrument model to the InstrumentBrand model with a BelongsTo relation.
     * One instrument belongs to one brand.
     *
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(InstrumentBrand::class, 'brand_id');
    }
}
