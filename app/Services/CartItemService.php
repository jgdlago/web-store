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

            $this->applyPromotions($existingCartItem);

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
        $product = $cartItem->product;

        if ($product->promotion) {
            $rule = $product->promotion->rule;

            if ($this->promotionRuleIsValid($rule)) {
                $subtotal = $this->calculatePromotionalSubtotal($cartItem, $rule);
                $cartItem->subtotal = number_format($subtotal, 2, '.', '');
                $cartItem->save();
            }
        }
    }

    /**
     * @param Rule $rule
     * @return bool
     */
    public function promotionRuleIsValid(Rule $rule): bool
    {
        return (
            $rule->buy_quantity !== null && $rule->get_quantity !== null ||
            $rule->minimum_quantity !== null && $rule->promotion_price !== null ||
            $rule->discount_percentage !== null
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

        if ($rule->buy_quantity != 1 && $rule->get_quantity) {
            return $this->calculateBuyGetXSubtotal($unitPrice, $quantity, $rule);
        } elseif ($rule->minimum_quantity && $rule->promotion_price) {
            return $this->calculateMinimumQuantityPromotionSubtotal($unitPrice, $quantity, $rule);
        } elseif ($rule->discount_percentage) {
            return $this->calculateDiscountPercentageSubtotal($unitPrice, $quantity, $rule);
        } elseif ($rule->buy_quantity === 1 && $rule->get_quantity === 1) {
            return $this->calculateBuyOneGetOne($unitPrice, $quantity);
        }

        return $this->calculateRegularSubtotal($unitPrice, $quantity);
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
     * @return float
     */
    public function calculateBuyOneGetOne(float $unitPrice, int $quantity): float
    {
        $paidItems = $quantity - floor($quantity / 2);

        return $paidItems * $unitPrice;
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
        }

        return $quantity * $unitPrice;
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
