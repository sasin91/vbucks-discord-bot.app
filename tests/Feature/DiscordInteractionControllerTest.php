<?php

use App\Listeners\OnSlashVBucks;
use App\Models\User;
use App\Models\VBuck;
use App\Services\CheckoutService;
use Laravel\Cashier\Checkout;
use Nwilging\LaravelDiscordBot\Events\ApplicationCommandInteractionEvent;
use Stripe\Checkout\Session;
use Symfony\Component\HttpFoundation\ParameterBag;

use function Pest\Laravel\mock;

it('creates an order for a /vbucks command', function () {
    /** @var User $customer */
    $customer = User::factory()->create([
        'discord_id' => '123456789012345678',
        'name' => 'sasin91',
    ]);

    mock(CheckoutService::class)
        ->expects('checkout')
        ->once()
        ->andReturn(new Checkout(
            $customer,
            tap(new Session(), function (Session $stripeSession) {
                $stripeSession->url = 'http://localhost/test';
            })
        ));

    $event = new ApplicationCommandInteractionEvent(
        new ParameterBag([
            'name' => 'vbucks',
            'options' => [
                [
                    'name' => 'amount',
                    'type' => 4,
                    'value' => 500,
                ],
                [
                    'name' => 'account',
                    'type' => 3,
                    'value' => 'sasin91',
                ],
            ],
            'type' => 1,
            'member' => [
                'user' => [
                    'avatar' => '972794f582c7ec4a2793bbf30388a877',
                    'global_name' => 'sasin91',
                    'id' => '123456789012345678',
                    'public_flags' => 0,
                    'username' => 'sasin91',
                ],
            ],
        ])
    );

    $handler = new OnSlashVBucks();
    $reply = $handler->replyContent($event);
    expect($reply)
        ->toBeString()
        ->toContain('http://localhost/test');

    $order = $customer->orders()->with('vbucks')->firstOrFail();

    expect($order->vbucks->count())->toBe(1);

    /** @var VBuck $product */
    $product = $order->vbucks->first();

    expect((int) $product->amount)->toBe(500);
    expect($product->account)->toBe('sasin91');
});
