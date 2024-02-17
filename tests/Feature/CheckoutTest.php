<?php

use App\Enums\OrderStatus;
use App\Models\User;
use App\Services\CheckoutService;
use Laravel\Cashier\Checkout;
use Stripe\Checkout\Session;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\mock;

it('orders vbucks', function () {
    $customer = User::factory()->create();

    mock(CheckoutService::class)
        ->expects('checkout')
        ->once()
        ->andReturn(new Checkout(
            $customer,
            new Session()
        ));

    actingAs($customer)
        ->post(route('checkout'), [
            'vbucks' => [
                [
                    'account' => 'johny69',
                    'amount' => 5000,
                ],
            ],
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    assertDatabaseHas('orders', [
        'customer_id' => $customer->id,
        'status' => OrderStatus::NEW,
    ]);

    assertDatabaseHas('v_bucks', [
        'account' => 'johny69',
        'amount' => 5000,
    ]);
});
