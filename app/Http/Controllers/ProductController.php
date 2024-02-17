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
        return view('pages.productIndex', compact('products'));
    }

    /**
     * @param Product|int $productId
     * @return View
     */
    public function show(Product|int $productId): View
    {
        $product = $this->productRepository->getModelByid($productId);
        return view('pages.productShow', compact('product'));
    }

    /**
     * @param ProductFormRequest $productDetails
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(ProductFormRequest $productDetails): RedirectResponse
    {
        $securityGroup = $this->productRepository->createModel($productDetails->safe()->toArray());
        return redirect()->route('product.index');
    }

    public function update(ProductFormRequest $productDetails, Product|int $productId): RedirectResponse
    {
        $this->productRepository->updateModel($productDetails->safe()->toArray(), $productId);
        return redirect()->route('product.index');
    }

    /**
     * @param Product|int $productId
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Product|int $productId): RedirectResponse
    {
        $this->productRepository->deleteModel($productId);
        return redirect()->route('product.index');
    }
}
