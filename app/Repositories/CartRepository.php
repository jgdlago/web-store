<?php

namespace App\Repositories;

use App\Models\Cart;
use App\RepositoryInterfaces\CartRepositoryInterface;

class CartRepository extends BaseRepository implements CartRepositoryInterface
{
    public function __construct(Cart $cart)
    {
        parent::__construct($cart);
    }

    /**
     * @param int $userId
     * @return Cart|null
     */
    public function getCartByUserId(int $userId): ?Cart
    {
        return Cart::where('user_id', $userId)->first();
    }
}
