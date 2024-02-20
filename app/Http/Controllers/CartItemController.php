<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemFormRequest;
use App\Models\CartItem;
use App\RepositoryInterfaces\CartItemRepositoryInterface;
use App\ServiceInterfaces\CartItemServiceInterface;
use App\ServiceInterfaces\CartServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;

class CartItemController extends Controller
{
    protected CartItemRepositoryInterface $cartItemRepository;
    protected CartItemServiceInterface $cartItemService;
    protected CartServiceInterface $cartService;
    public function __construct(CartItemRepositoryInterface $cartItemRepository,
        CartItemServiceInterface $cartItemService,
        CartServiceInterface $cartService
    )
    {
        $this->cartItemRepository = $cartItemRepository;
        $this->cartItemService = $cartItemService;
        $this->cartService = $cartService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $cartItems = $this->cartItemRepository->getAllModel();
        return view('carts.index', compact('cartItems'));
    }

    /**
     * @param CartItem|int $cartItemId
     * @return View
     */
    public function show(CartItem|int $cartItemId): View
    {
        $cartItem = $this->cartItemRepository->getModelByid($cartItemId);
        return view('carts.show', compact('cartItem'));
    }

    /**
     * @param CartItemFormRequest $cartItemDetails
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(CartItemFormRequest $cartItemDetails): RedirectResponse
    {
        $cartItem = $this->cartItemService->createNewCartItem($cartItemDetails->safe()->toArray());
        return redirect()->route('carts.index');
    }

    /**
     * @param CartItemFormRequest $cartItemDetails
     * @param CartItem|int $cartItemId
     * @return RedirectResponse
     */
    public function update(CartItemFormRequest $cartItemDetails, CartItem|int $cartItemId): RedirectResponse
    {
        $this->cartItemRepository->updateModel($cartItemDetails->safe()->toArray(), $cartItemId);
        return redirect()->route('carts.index');
    }

    /**
     * @param CartItem $cartItem
     * @return RedirectResponse
     */
    public function destroy(CartItem $cartItem): RedirectResponse
    {
        $cartItem->delete();
        return redirect()->route('carts.index')->with('success', 'Item removido do carrinho com sucesso.');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('carts.create');
    }

    /**
     * @param CartItem|int $cartItemId
     * @return View
     */
    public function edit(CartItem|int $cartItemId): View
    {
        $cartItem = $this->cartItemRepository->getModelByid($cartItemId);
        return view('carts.edit', compact('cartItem'));
    }
}
