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
    protected PurchaseHistoricServiceInterface $historicService;
    protected PurchaseHistoricRepositoryInterface $purchaseRepository;
    public function __construct(PurchaseHistoricRepositoryInterface $purchaseRepository, PurchaseHistoricServiceInterface $historicService)
    {
        $this->purchaseRepository = $purchaseRepository;
        $this->historicService = $historicService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $purchaseHistories = $this->purchaseRepository->getHistoryByUser(Auth::id());
        return view('purchaseHistories.index', compact('purchaseHistories'));
    }

    /**
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(): RedirectResponse
    {
        $this->historicService->recordPurchaseHistoric();
        return redirect()->route('purchaseHistories.index');
    }

}
