<?php

namespace App\Disord\Commands;

use App\Data\CheckoutData;
use App\Data\VBuckData;
use App\Features\OrderPayments;
use App\Models\Order;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VBucks extends DiscordCommand
{
    const AMOUNT = 'amount';

    const ACCOUNT = 'account';

    public function type(): int
    {
        return self::TYPE_CHAT_INPUT;
    }

    public function options(): array
    {
        return [
            [
                'type' => self::OPTION_TYPE_INTEGER,
                'name' => 'amount',
                'description' => 'How many VBucks do you want?',
            ],
            [
                'type' => self::OPTION_TYPE_STRING,
                'name' => 'account',
                'description' => 'The receiving account name',
            ],
        ];
    }

    public function option(Request $request, Closure $predicate, $default = null)
    {
        return $request
            ->collect('data.options')
            ->firstWhere($predicate) ?? $default;
    }

    public function amount(Request $request): int
    {
        $option = $this->option(
            $request,
            fn ($option) => $option['name'] === static::AMOUNT,
            0
        );

        return (int) $option['value'];
    }

    public function account(Request $request): string
    {
        $option = $this->option(
            $request,
            fn ($option) => $option['name'] === static::ACCOUNT,
            ''
        );

        return (string) $option['value'];
    }

    public function discordId(Request $request): ?string
    {
        return $request->string('member.user.id');
    }

    public function content(Request $request): string
    {
        $amount = $this->amount($request);
        $account = $this->account($request);
        $discordId = $this->discordId($request);

        $customer = $discordId
            ? User::query()->where('discord_id', $discordId)->firstOrFail()
            : User::defaultCheckoutCustomer();

        $order = Order::fromCheckoutData(
            new CheckoutData(
                vbucks: VBuckData::collection([
                    new VBuckData(
                        account: $account,
                        amount: $amount
                    ),
                ]),
                customer: $customer
            )
        );

        return OrderPayments::state()
            ? sprintf(
                'Understood, please visit %s to pay your order.',
                $order->checkout()
                    ->asStripeCheckoutSession()
                    ->url
            )
            : sprintf(
                'Understood, an order for %d VBucks to %s has been created.',
                number_format((float) $amount),
                $account
            );
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return response()->json([
            'type' => self::RESPONSE_TYPE_CHANNEL_MESSAGE_WITH_SOURCE,
            'data' => [
                'content' => $this->content($request),
                'ephemeral' => true,
            ],
        ]);
    }
}
