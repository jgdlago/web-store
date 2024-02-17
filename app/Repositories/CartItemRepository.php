<?php

namespace App\Repositories;

use App\Models\CartItem;
use App\RepositoryInterfaces\CartItemRepositoryInterface;

class CartItemRepository extends BaseRepository implements CartItemRepositoryInterface
{
    public function __construct(CartItem $cartItem)
    {
        parent::__construct($cartItem);
    }
}
