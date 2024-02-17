<?php

namespace App\Repositories;

use App\Models\Promotion;
use App\RepositoryInterfaces\PromotionRepositoryInterface;

class PromotionRepository extends BaseRepository implements PromotionRepositoryInterface
{
    public function __construct(Promotion $promotion)
    {
        parent::__construct($promotion);
    }
}
