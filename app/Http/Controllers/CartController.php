<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartFormRequest;
use App\Models\Cart;
use App\Models\PurchaseHistory;
use App\RepositoryInterfaces\CartRepositoryInterface;
use App\ServiceInterfaces\CartServiceInterface;
use http\Client\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Exception;

class CartController extends Controller
{
    protected CartRepositoryInterface $cartRepository;
    protected CartServiceInterface $cartService;
    public function __construct(CartRepositoryInterface $cartRepository, CartServiceInterface $cartService)
    {
        $this->cartRepository = $cartRepository;
        $this->cartService = $cartService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $myCart = $this->cartRepository->getCartByUserId(Auth::id());
        return view('carts.index', compact('myCart'));
    }

    /**
     * @param Cart|int $cartId
     * @return View
     */
    public function show(Cart|int $cartId): View
    {
        $product = $this->cartRepository->getModelByid($cartId);
        return view('carts.show', compact('product'));
    }

    /**
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        $cart = $this->cartService->createNewCart(user: Auth::user());
        return redirect()->route('carts.index');
    }

    /**
     * @param CartFormRequest $cartDetails
     * @param Cart|int $cartId
     * @return RedirectResponse
     */
    public function update(CartFormRequest $cartDetails, Cart|int $cartId): RedirectResponse
    {
        $this->cartRepository->updateModel($cartDetails->safe()->toArray(), $cartId);
        return redirect()->route('carts.index');
    }

    /**
     * @param Cart|int $cartId
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Cart|int $cartId): RedirectResponse
    {
        $this->cartRepository->deleteModel($cartId);
        return redirect()->route('carts.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('carts.create');
    }

    /**
     * @param Cart|int $cartId
     * @return View
     */
    public function edit(Cart|int $cartId): View
    {
        $cart = $this->cartRepository->getModelByid($cartId);
        return view('carts.edit', compact('cart'));
    }
}
