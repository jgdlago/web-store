<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemFormRequest;
use App\Models\CartItem;
use App\RepositoryInterfaces\CartItemRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;

class CartItemController extends Controller
{
    protected CartItemRepositoryInterface $cartItemRepository;
    public function __construct(CartItemRepositoryInterface $cartItemRepository)
    {
        $this->cartItemRepository = $cartItemRepository;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $cartItems = $this->cartItemRepository->getAllModel();
        return view('cart-items.index', compact('cartItems'));
    }

    /**
     * @param CartItem|int $cartItemId
     * @return View
     */
    public function show(CartItem|int $cartItemId): View
    {
        $cartItem = $this->cartItemRepository->getModelByid($cartItemId);
        return view('cartItems.show', compact('cartItem'));
    }

    /**
     * @param CartItemFormRequest $cartItemDetails
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(CartItemFormRequest $cartItemDetails): RedirectResponse
    {
        $this->cartItemRepository->createModel($cartItemDetails->safe()->toArray());
        return redirect()->route('cartItems.index');
    }

    /**
     * @param CartItemFormRequest $cartItemDetails
     * @param CartItem|int $cartItemId
     * @return RedirectResponse
     */
    public function update(CartItemFormRequest $cartItemDetails, CartItem|int $cartItemId): RedirectResponse
    {
        $this->cartItemRepository->updateModel($cartItemDetails->safe()->toArray(), $cartItemId);
        return redirect()->route('cartItems.index');
    }

    /**
     * @param CartItem|int $cartItemId
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(CartItem|int $cartItemId): RedirectResponse
    {
        $this->cartItemRepository->deleteModel($cartItemId);
        return redirect()->route('cartItems.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('cartItems.create');
    }

    /**
     * @param CartItem|int $cartItemId
     * @return View
     */
    public function edit(CartItem|int $cartItemId): View
    {
        $cartItem = $this->cartItemRepository->getModelByid($cartItemId);
        return view('cart-Items.edit', compact('cartItem'));
    }
}
