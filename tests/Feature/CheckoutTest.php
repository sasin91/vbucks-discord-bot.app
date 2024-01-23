<?php

use App\Models\User;

use function Pest\Laravel\actingAs;

it('orders vbucks', function () {
    $customer = User::factory()->create();

    actingAs($customer)
        ->post(route('checkout'), [
            'vbucks' => [
                'character_name' => 'johny69',
                'amount' => 5000,
            ],
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect();
});
