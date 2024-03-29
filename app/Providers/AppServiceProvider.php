<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\CartItemRepository;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use App\Repositories\PromotionRepository;
use App\Repositories\PurchaseHistoricRepository;
use App\Repositories\RuleRepository;
use App\RepositoryInterfaces\BaseRepositoryInterface;
use App\RepositoryInterfaces\CartItemRepositoryInterface;
use App\RepositoryInterfaces\CartRepositoryInterface;
use App\RepositoryInterfaces\ProductRepositoryInterface;
use App\RepositoryInterfaces\PromotionRepositoryInterface;
use App\RepositoryInterfaces\PurchaseHistoricRepositoryInterface;
use App\RepositoryInterfaces\RuleRepositoryInterface;
use App\ServiceInterfaces\CartItemServiceInterface;
use App\ServiceInterfaces\CartServiceInterface;
use App\ServiceInterfaces\PurchaseHistoricServiceInterface;
use App\Services\CartItemService;
use App\Services\CartService;
use App\Services\PurchaseHistoricService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CartItemRepositoryInterface::class, CartItemRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(PromotionRepositoryInterface::class, PromotionRepository::class);
        $this->app->bind(RuleRepositoryInterface::class, RuleRepository::class);
        $this->app->bind(PurchaseHistoricRepositoryInterface::class, PurchaseHistoricRepository::class);

        $this->app->bind(CartItemServiceInterface::class, CartItemService::class);
        $this->app->bind(CartServiceInterface::class, CartService::class);
        $this->app->bind(PurchaseHistoricServiceInterface::class, PurchaseHistoricService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
