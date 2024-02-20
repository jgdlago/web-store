<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Rule;
use App\Models\User;
use App\RepositoryInterfaces\CartRepositoryInterface;
use App\ServiceInterfaces\CartServiceInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;

class CartService implements CartServiceInterface
{
    protected CartRepositoryInterface $cartRepository;
    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * @param User $user
     * @return Cart|Model
     * @throws Exception
     */
    public function createNewCart(User $user): Cart|Model
    {
        if (!$user->cart) {
            return $this->cartRepository->createModel([
                'user_id' => $user->id,
                'total_price' => 0
            ]);
        }

        return $user->cart;
    }

    /**
     * @param int $cartId
     * @return void
     */
    public function calculateTotalPrice(int $cartId): void
    {
        $cart = $this->cartRepository->getModelById($cartId);

        foreach ($cart->cartItem as $item) {
            if ($item->product->promotion) {
                $rule = $item->product->promotion->rule;

                if ($this->promotionRuleIsValid($rule)) {
                    $subtotal = $this->calculatePromotionalSubtotal($item, $rule);
                    $item->subtotal = $subtotal;
                    $item->save();
                }
            }
        }
    }

    /**
     * @param $rule
     * @return bool
     * buy_quantity && get_quantity
     * minimum_quantity && promotion_price
     * discount_percentage
     */
    public function promotionRuleIsValid($rule): bool
    {
        $filledFields = collect($rule->toArray())
            ->filter(function ($value, $key) {
                return !is_null($value);
            })
            ->keys()
            ->toArray();

        return (
            (in_array('buy_quantity', $filledFields) && in_array('get_quantity', $filledFields)) ||
            (in_array('minimum_quantity', $filledFields) && in_array('promotion_price', $filledFields)) ||
            in_array('discount_percentage', $filledFields)
        );
    }

    /**
     * @param CartItem $item
     * @param Rule $rule
     * @return float
     */
    public function calculatePromotionalSubtotal(CartItem $item, Rule $rule): float
    {
        $unitPrice = floatval(str_replace(',', '.', $item->product->price));
        $quantity = $item->quantity;

        if ($rule->buy_quantity && $rule->get_quantity) {
            return $this->calculateBuyGetXSubtotal($unitPrice, $quantity, $rule);
        } elseif ($rule->minimum_quantity && $rule->promotion_price) {
            return $this->calculateMinimumQuantityPromotionSubtotal($unitPrice, $quantity, $rule);
        } elseif ($rule->discount_percentage) {
            return $this->calculateDiscountPercentageSubtotal($unitPrice, $quantity, $rule);
        } else {
            return $this->calculateRegularSubtotal($unitPrice, $quantity);
        }
    }

    /**
     * @param float $unitPrice
     * @param int $quantity
     * @param Rule $rule
     * @return float
     */
    public function calculateBuyGetXSubtotal(float $unitPrice, int $quantity, Rule $rule): float
    {
        $buyQuantity = $rule->buy_quantity;
        $getQuantity = $rule->get_quantity;

        $sets = floor($quantity / $buyQuantity);
        $remaining = $quantity % $buyQuantity;

        $subtotal = ($sets * $buyQuantity * $unitPrice) + ($remaining * $unitPrice);

        $freeProducts = $sets * $getQuantity;

        $subtotal -= $freeProducts * $unitPrice;

        return $subtotal;
    }

    /**
     * @param float $unitPrice
     * @param int $quantity
     * @param Rule $rule
     * @return float
     */
    public function calculateMinimumQuantityPromotionSubtotal(float $unitPrice, int $quantity, Rule $rule): float
    {
        $minimumQuantity = $rule->minimum_quantity;
        $promotionPrice = floatval(str_replace(',', '.', $rule->promotion_price));

        if ($quantity >= $minimumQuantity) {
            return $quantity * $promotionPrice;
        } else {
            return $quantity * $unitPrice;
        }
    }

    /**
     * @param float $unitPrice
     * @param int $quantity
     * @param Rule $rule
     * @return float
     */
    public function calculateDiscountPercentageSubtotal(float $unitPrice, int $quantity, Rule $rule): float
    {
        $discountPercentage = $rule->discount_percentage;
        $discountedPrice = $unitPrice * (1 - ($discountPercentage / 100));

        return $quantity * $discountedPrice;
    }

    /**
     * @param $unitPrice
     * @param $quantity
     * @return float
     */
    public function calculateRegularSubtotal($unitPrice, $quantity): float
    {
        return $quantity * $unitPrice;
    }

}
