<?php

namespace App\Listeners;

use App\Classes\UpdateTotalPriceHelpers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateTotalPriceListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        UpdateTotalPriceHelpers::updateTotalPrice();
    }
}
