<?php

namespace App\ServiceInterfaces;

use App\Models\CartItem;
use Illuminate\Database\Eloquent\Model;

interface CartItemServiceInterface
{
    public function createNewCartItem(array $cartItemDetails): CartItem|Model;
    public function calculateSubtotal(int $quantity, string $price): string;
}
