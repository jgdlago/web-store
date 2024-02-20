<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Rule;
use App\RepositoryInterfaces\CartItemRepositoryInterface;
use App\ServiceInterfaces\CartItemServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Exception;

class CartItemService implements CartItemServiceInterface
{
    protected CartItemRepositoryInterface $cartItemRepository;
    public function __construct(CartItemRepositoryInterface $cartItemRepository)
    {
        $this->cartItemRepository = $cartItemRepository;
    }

    /**
     * @param array $cartItemDetails
     * @return CartItem|Model
     * @throws Exception
     */
    public function createNewCartItem(array $cartItemDetails): CartItem|Model
    {
        $product = Product::findOrFail($cartItemDetails['product_id']);
        $cart = Cart::findOrFail($cartItemDetails['cart_id']);

        $existingCartItem = $cart->cartItem()->where('product_id', $product->id)->first();

        if ($existingCartItem) {
            $existingCartItem->quantity += $cartItemDetails['quantity'];
            $existingCartItem->subtotal = $this->calculateSubtotal($existingCartItem->quantity, $product->price);
            $existingCartItem->save();

            return $existingCartItem;
        }

        $cartItemDetails['subtotal'] = $this->calculateSubtotal($cartItemDetails['quantity'], $product->price);

        $cartItem = $this->cartItemRepository->createModel($cartItemDetails);

        $this->applyPromotions($cartItem);

        return $cartItem;
    }

    /**
     * @param int $quantity
     * @param string $price
     * @return string
     */
    public function calculateSubtotal(int $quantity, string $price): string
    {
        $priceDecimal = floatval(str_replace(',', '.', $price));

        $subtotal = bcmul($priceDecimal, $quantity, 2);

        return number_format($subtotal, 2);
    }

    /**
     * @param CartItem $cartItem
     * @return void
     */
    public function applyPromotions(CartItem $cartItem): void
    {
        if ($cartItem->product->promotion) {
            $rule = $cartItem->product->promotion->rule;

            if ($this->promotionRuleIsValid($rule)) {
                $subtotal = $this->calculatePromotionalSubtotal($cartItem, $rule);
                $cartItem->subtotal = number_format($subtotal, 2, ',', '.');
                $cartItem->save();
            }
        }
    }

    /**
     * @param Rule $rule
     * @return bool
     * buy_quantity && get_quantity
     * minimum_quantity && promotion_price
     * discount_percentage
     */
    public function promotionRuleIsValid(Rule $rule): bool
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
     * @param CartItem $cartItem
     * @param Rule $rule
     * @return float
     */
    public function calculatePromotionalSubtotal(CartItem $cartItem, Rule $rule): float
    {
        $unitPrice = floatval(str_replace(',', '.', $cartItem->product->price));
        $quantity = $cartItem->quantity;

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
