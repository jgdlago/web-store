<?php

namespace App\Repositories;

use App\Models\PurchaseHistory;
use App\RepositoryInterfaces\PurchaseHistoricRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PurchaseHistoricRepository extends BaseRepository implements PurchaseHistoricRepositoryInterface
{
    public function __construct(PurchaseHistory $purchaseHistory)
    {
        parent::__construct($purchaseHistory);
    }

    /**
     * @param int $userId
     * @return Collection
     */
    public function getHistoryByUser(int $userId): Collection
    {
        return PurchaseHistory::where('user_id', $userId)->get();
    }
}
