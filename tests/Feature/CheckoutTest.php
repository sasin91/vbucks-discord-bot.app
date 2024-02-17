<?php

use App\Enums\OrderStatus;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

it('orders vbucks', function () {
    $customer = User::factory()->create();

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
