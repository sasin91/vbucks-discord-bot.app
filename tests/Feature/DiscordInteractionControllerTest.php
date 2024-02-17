<?php

use App\Http\Middleware\VerifyDiscordSignature;
use App\Models\User;
use App\Models\VBuck;
use App\Services\CheckoutService;
use Laravel\Cashier\Checkout;
use Stripe\Checkout\Session;

use function Pest\Laravel\mock;
use function Pest\Laravel\withoutMiddleware;

it('creates an order for a /vbucks command', function ($data) {
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

    $response = withoutMiddleware(VerifyDiscordSignature::class)->postJson(
        '/api/discord',
        $data
    );

    $response->assertOk();

    $content = $response->json('content');
    $ephemeral = $response->json('ephemeral');

    expect($content)
        ->toBeString()
        ->toContain('http://localhost/test');

    expect($ephemeral)
        ->toBeBool()
        ->toEqual(true);
    $order = $customer->orders()->with('vbucks')->firstOrFail();

    expect($order->vbucks->count())->toBe(1);

    /** @var VBuck $product */
    $product = $order->vbucks->first();

    expect((int) $product->amount)->toBe(500);
    expect($product->account)->toBe('sasin91');
})->with([
    function () {
        $json = file_get_contents(base_path('/tests/__fixtures__/discord.slashvbucks.json'));
        $data = \json_decode($json, true);
        if (\json_last_error() !== \JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('json_decode error: '.\json_last_error_msg());
        }

        return $data;
    },
]);
