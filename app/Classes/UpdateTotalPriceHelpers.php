<?php

namespace App\Classes;

use Illuminate\Support\Facades\Auth;

class UpdateTotalPriceHelpers
{
    /**
     * @return void
     */
    public static function updateTotalPrice(): void
    {
        $cart = Auth::user()->cart;
        $totalPrice = 0;

        foreach ($cart->cartItem as $cartItem) {
            $subtotal = floatval(str_replace(',', '.', $cartItem->subtotal));

            if (is_numeric($subtotal)) {
                $totalPrice += $subtotal;
            }
        }

        $cart->total_price = $totalPrice;
        $cart->save();
    }
}
