<?php

namespace App\Services;

use App\Models\Cart;
use App\RepositoryInterfaces\CartRepositoryInterface;
use App\ServiceInterfaces\CartServiceInterface;

class CartService implements CartServiceInterface
{
    protected CartRepositoryInterface $cartRepository;
    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function calculateTotalPrice(int $quantity, string $price): string
    {
        // TODO: Implement calculateTotalPrice() method.
    }
}
