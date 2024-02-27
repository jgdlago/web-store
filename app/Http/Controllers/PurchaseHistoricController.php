<?php

namespace App\Http\Controllers;

use App\RepositoryInterfaces\PurchaseHistoricRepositoryInterface;
use App\ServiceInterfaces\PurchaseHistoricServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Exception;

class PurchaseHistoricController extends Controller
{
    protected PurchaseHistoricRepositoryInterface $purchaseHistoricRepository;
    protected PurchaseHistoricServiceInterface $purchaseHistoricService;
    public function __construct(PurchaseHistoricRepositoryInterface $purchaseHistoricRepository, PurchaseHistoricServiceInterface $purchaseHistoricService)
    {
        $this->purchaseHistoricRepository = $purchaseHistoricRepository;
        $this->purchaseHistoricService = $purchaseHistoricService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $purchaseHistories = $this->purchaseHistoricRepository->getHistoryByUser(Auth::id());
        return view('purchaseHistories.index', compact('purchaseHistories'));
    }

    /**
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(): RedirectResponse
    {
        $this->purchaseHistoricService->recordPurchaseHistoric();
        return redirect()->route('purchaseHistories.index');
    }
}
