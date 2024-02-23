<?php

namespace App\Repositories;

use App\Models\Product;
use App\RepositoryInterfaces\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }
}
