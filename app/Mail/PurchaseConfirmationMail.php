<?php

namespace App\Mail;

use App\Models\PurchaseHistory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseConfirmationMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public PurchaseHistory $purchase;

    public function __construct(PurchaseHistory $purchase)
    {
        $this->purchase = $purchase;
    }

    public function build()
    {
        return $this->markdown('emails.purchase_confirmation')
            ->subject('Confirmação de Compra - ' . $this->purchase->id);
    }
}
