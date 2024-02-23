<?php

namespace App\ServiceInterfaces;

use App\Models\PurchaseHistory;

interface PurchaseHistoricServiceInterface
{
    public function recordPurchaseHistoric(): PurchaseHistory;
}
