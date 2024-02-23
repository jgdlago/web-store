<?php

namespace App\RepositoryInterfaces;

use Illuminate\Database\Eloquent\Collection;

interface PurchaseHistoricRepositoryInterface
{
    public function getHistoryByUser(int $userId): Collection;
}
