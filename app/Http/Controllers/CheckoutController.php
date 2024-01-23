<?php

namespace App\Http\Controllers;

use App\Data\CheckoutData;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, CheckoutData $checkoutData)
    {
        $order = DB::transaction(
            fn () => Order::fromCheckoutData($checkoutData, $request->user()),
            3
        );

        $checkout = $order->checkout();

        return $checkout->redirect();
    }
}
