<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
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

        return $this->cartItemRepository->createModel($cartItemDetails);
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
}
