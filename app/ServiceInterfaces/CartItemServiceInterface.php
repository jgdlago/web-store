<?php

namespace App\ServiceInterfaces;

use App\Models\CartItem;

interface CartItemServiceInterface
{
    public function createNewCartItem(array $cartItemDetails): CartItem;
    public function calculateSubtotal(int $quantity, string $price): string;
}
