<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'rule_id'
    ];

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return HasOne
     */
    public function rule(): HasOne
    {
        return $this->hasOne(Rule::class);
    }

}
