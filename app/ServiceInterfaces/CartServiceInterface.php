<?php

namespace App\ServiceInterfaces;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Rule;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

interface CartServiceInterface
{
    public function createNewCart(User $user): Cart|Model;
    public function calculateTotalPrice(int $cartId): void;
    public function calculatePromotionalSubtotal(CartItem $item, Rule $rule): float;
    public function calculateBuyGetXSubtotal(float $unitPrice, int $quantity, Rule $rule): float;
    public function calculateMinimumQuantityPromotionSubtotal(float $unitPrice, int $quantity, Rule $rule): float;
    public function calculateDiscountPercentageSubtotal(float $unitPrice, int $quantity, Rule $rule): float;
    public function calculateRegularSubtotal($unitPrice, $quantity): float;
}
