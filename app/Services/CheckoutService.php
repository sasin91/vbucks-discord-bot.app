<?php

namespace App\Services;

use App\Models\Order;

class CheckoutService
{
    public function checkout(Order $order)
    {
        $products = [];

        if ($order->vbucks->count() > 0) {
            $products[] = [
                config('vbucks.stripe.price_id') => $order->vbucks->count(),
            ];
        }

        return $order->customer->checkout($products, [
            'success_url' => route('checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
            'metadata' => [
                'order_id' => $order->id,
            ],
        ]);
    }
}
