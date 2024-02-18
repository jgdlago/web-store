<?php

namespace App\ServiceInterfaces;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

interface CartServiceInterface
{
    public function createNewCart(User $user): Cart|Model;

}
