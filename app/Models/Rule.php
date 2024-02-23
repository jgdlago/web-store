<?php

namespace App\Models;

use App\Casts\PriceCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Rule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'buy_quantity',
        'get_quantity',
        'minimum_quantity',
        'promotion_price',
        'discount_percentage'
    ];

    protected $casts = [
        'promotion_price' => PriceCast::class,
    ];

    /**
     * @return BelongsToMany
     */
    public function promotions(): BelongsToMany
    {
        return $this->belongsToMany(Promotion::class);
    }
}
