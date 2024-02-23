<?php

namespace App\Models;

use App\Casts\PriceCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PurchaseHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'products',
        'product_id'
    ];

    protected $casts = [
        'total_price' => PriceCast::class,
    ];

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'subtotal');
    }
}
