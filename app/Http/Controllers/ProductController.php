<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Models\Product;
use App\RepositoryInterfaces\ProductRepositoryInterface;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    protected ProductRepositoryInterface $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $products = $this->productRepository->getAllModel();
        return view('products.index', compact('products'));
    }

    /**
     * @param Product|int $productId
     * @return View
     */
    public function show(Product|int $productId): View
    {
        $product = $this->productRepository->getModelByid($productId);
        return view('products.show', compact('product'));
    }

    /**
     * @param ProductFormRequest $productDetails
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(ProductFormRequest $productDetails): RedirectResponse
    {
        $this->productRepository->createModel($productDetails->safe()->toArray());
        return redirect()->route('products.index');
    }

    /**
     * @param ProductFormRequest $productDetails
     * @param Product|int $productId
     * @return RedirectResponse
     */
    public function update(ProductFormRequest $productDetails, Product|int $productId): RedirectResponse
    {
        $this->productRepository->updateModel($productDetails->safe()->toArray(), $productId);
        return redirect()->route('products.index');
    }

    /**
     * @param Product|int $productId
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Product|int $productId): RedirectResponse
    {
        $this->productRepository->deleteModel($productId);
        return redirect()->route('products.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * @param Product|int $productId
     * @return View
     */
    public function edit(Product|int $productId): View
    {
        $product = $this->productRepository->getModelByid($productId);
        return view('products.edit', compact('product'));
    }
}
