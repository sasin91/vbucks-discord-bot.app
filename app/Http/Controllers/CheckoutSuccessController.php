<?php

namespace App\Http\Controllers;

use App\Disord\Commands\SlashVBucksCommand;
use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;

class CheckoutSuccessController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $sessionId = $request->get('session_id');

        $orderId = Cashier::stripe()->checkout->sessions->retrieve($sessionId)['metadata']['order_id'] ?? null;

        $order = Order::query()->findOrFail($orderId);

        $order->update(['status' => OrderStatus::PAID]);

        if ($order->vbucks->isNotEmpty()) {
            $slashVBucksCommand = new SlashVBucksCommand();

            $slashVBucksCommand->onCheckoutSuccess($order);
        }

        return view('checkout.success', ['order' => $order]);
    }
}
