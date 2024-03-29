<?php

namespace App\Models;

use App\Casts\PriceCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product_code',
        'description',
        'price',
        'unit_of_measurement'
    ];

    protected $casts = [
        'price' => PriceCast::class
    ];

    /**
     * @return BelongsTo
     */
    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class, 'product_code', 'product_code');
    }

    /**
     * @return BelongsToMany
     */
    public function purchaseHistories(): BelongsToMany
    {
        return $this->belongsToMany(PurchaseHistory::class)->withPivot('quantity', 'subtotal');
    }
}
