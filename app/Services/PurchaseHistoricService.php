<?php

namespace App\Services;

use App\Models\PurchaseHistory;
use App\RepositoryInterfaces\PurchaseHistoricRepositoryInterface;
use App\ServiceInterfaces\PurchaseHistoricServiceInterface;
use Illuminate\Support\Facades\Auth;

class PurchaseHistoricService implements PurchaseHistoricServiceInterface
{
    protected PurchaseHistoricRepositoryInterface $purchaseHistoricRepository;
    public function __construct(PurchaseHistoricRepositoryInterface $purchaseHistoricRepository)
    {
        $this->purchaseHistoricRepository = $purchaseHistoricRepository;
    }

    /**
     * @return PurchaseHistory
     */
    public function recordPurchaseHistoric(): PurchaseHistory
    {
        $myCart = Auth::user()->cart;

        $productsData = [];

        foreach ($myCart->cartItem as $item) {
            $productsData[] = [
                'product_name' => $item->product->name,
                'product_price' => $item->product->price,
                'quantity' => $item->quantity,
                'subtotal' => $item->subtotal,
            ];
        }

        $purchaseHistory = PurchaseHistory::create([
            'user_id' => Auth::id(),
            'total_price' => $myCart->total_price,
            'purchased_at' => now(),
            'products' => json_encode($productsData),
        ]);

        $myCart->cartItem()->delete();
        $myCart->total_price = 0;
        $myCart->save();

        return $purchaseHistory;
    }
}
