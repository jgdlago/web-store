<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromotionFormRequest;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Rule;
use App\RepositoryInterfaces\PromotionRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;

class PromotionController extends Controller
{
    protected PromotionRepositoryInterface $promotionRepository;
    public function __construct(PromotionRepositoryInterface $promotionRepository)
    {
        $this->promotionRepository = $promotionRepository;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $promotions = $this->promotionRepository->getAllModel();
        return view('promotions.index', compact('promotions'));
    }

    /**
     * @param Promotion|int $promotionId
     * @return View
     */
    public function show(Promotion|int $promotionId): View
    {
        $product = $this->promotionRepository->getModelByid($promotionId);
        return view('promotions.show', compact('product'));
    }

    /**
     * @param PromotionFormRequest $promotionDetails
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(PromotionFormRequest $promotionDetails): RedirectResponse
    {
        $this->promotionRepository->createModel($promotionDetails->safe()->toArray());
        return redirect()->route('promotions.index');
    }

    /**
     * @param PromotionFormRequest $promotionDetails
     * @param Promotion|int $promotionId
     * @return RedirectResponse
     */
    public function update(PromotionFormRequest $promotionDetails, Promotion|int $promotionId): RedirectResponse
    {
        $this->promotionRepository->updateModel($promotionDetails->safe()->toArray(), $promotionId);
        return redirect()->route('promotions.index');
    }

    /**
     * @param Promotion|int $promotionId
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Promotion|int $promotionId): RedirectResponse
    {
        $this->promotionRepository->deleteModel($promotionId);
        return redirect()->route('promotions.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $rules = Rule::all();
        $products = Product::all();
        return view('promotions.create', compact('rules', 'products'));
    }

    /**
     * @param Promotion|int $promotionId
     * @return View
     */
    public function edit(Promotion|int $promotionId): View
    {
        $promotion = $this->promotionRepository->getModelByid($promotionId);
        return view('promotions.edit', compact('promotion'));
    }

}
