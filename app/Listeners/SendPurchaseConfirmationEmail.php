<?php

namespace App\Listeners;

use App\Events\PurchaseHistoryCreated;
use App\Mail\PurchaseConfirmationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SendPurchaseConfirmationEmail implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(PurchaseHistoryCreated $event)
    {
        $user = User::findOrFail($event->purchaseHistory->user_id);
        $purchase = $event->purchaseHistory;

        Mail::to($user->email)->send(new PurchaseConfirmationMail($purchase));
    }
}
