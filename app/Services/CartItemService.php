<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\RepositoryInterfaces\CartItemRepositoryInterface;
use App\ServiceInterfaces\CartItemServiceInterface;
use Ramsey\Uuid\Type\Decimal;
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
     * @return CartItem
     * @throws Exception
     */
    public function createNewCartItem(array $cartItemDetails): CartItem
    {
        $product = Product::findOrFail($cartItemDetails['product_id']);
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
        $priceDecimal = (float) $price;

        $subtotal = bcmul($priceDecimal, $quantity, 2);

        return number_format($subtotal, 2);
    }
}
