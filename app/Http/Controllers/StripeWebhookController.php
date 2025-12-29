<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Http\Controllers\WebhookController;

class StripeWebhookController extends WebhookController
{
    /**
     * Handle the customer.subscription.created webhook.
     */
    protected function handleInvoicePaymentPaid(array $payload): void
    {
        Log::info('🔥 MOJ WEBHOOK JE POZVAN 🔥');
    }
    //nepotrebno je jer svakak se ne overajduje metoda







}
