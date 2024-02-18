<?php

namespace App\ServiceInterfaces;

use App\Models\Cart;

interface CartServiceInterface
{
    public function calculateTotalPrice(int $quantity, string $price): string;
}
