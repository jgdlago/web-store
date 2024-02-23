<?php

namespace App\RepositoryInterfaces;

use App\Models\Cart;

interface CartRepositoryInterface
{
    public function getCartByUserId(int $userId): ?Cart;
}
