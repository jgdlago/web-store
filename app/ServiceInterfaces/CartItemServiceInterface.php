<?php

namespace App\ServiceInterfaces;

use App\Models\CartItem;
use App\Models\Rule;
use Illuminate\Database\Eloquent\Model;

interface CartItemServiceInterface
{
    public function createNewCartItem(array $cartItemDetails): CartItem|Model;
    public function calculateSubtotal(int $quantity, string $price): string;
    public function applyPromotions(CartItem $cartItem): void;
    public function promotionRuleIsValid(Rule $rule): bool;
    public function calculatePromotionalSubtotal(CartItem $cartItem, Rule $rule): float;
    public function calculateBuyGetXSubtotal(float $unitPrice, int $quantity, Rule $rule): float;
    public function calculateMinimumQuantityPromotionSubtotal(float $unitPrice, int $quantity, Rule $rule): float;
    public function calculateDiscountPercentageSubtotal(float $unitPrice, int $quantity, Rule $rule): float;
    public function calculateRegularSubtotal($unitPrice, $quantity): float;
}
