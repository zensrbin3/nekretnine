<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(Request $request, $name)
    {
        $plan = Plan::whereName($name)->firstOrFail();
        return $request->user()
            ->newSubscription('default', $plan->stripe_price_id)
            ->checkout([
                'success_url' => route('home', ['success' => 'Uspesna pretplata']),
                'cancel_url'  => route('home', ['error' => 'Greška pri plaćanju']),
            ]);
    }
}
