<?php

namespace App\Events;

use App\Models\PurchaseHistory;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PurchaseHistoryCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public PurchaseHistory $purchaseHistory;

    public function __construct(PurchaseHistory $purchaseHistory)
    {
        $this->purchaseHistory = $purchaseHistory;
    }
}
