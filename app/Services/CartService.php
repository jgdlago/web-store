<?php

namespace App\Services;

use App\Models\Cart;
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

}
