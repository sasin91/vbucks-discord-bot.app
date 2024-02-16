<?php

namespace App\Listeners;

use App\Data\CheckoutData;
use App\Data\VBuckData;
use App\Features\OrderPayments;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Collection;
use Nwilging\LaravelDiscordBot\Contracts\Listeners\ApplicationCommandInteractionEventListenerContract;
use Nwilging\LaravelDiscordBot\Events\ApplicationCommandInteractionEvent;

class OnSlashVBucks implements ApplicationCommandInteractionEventListenerContract
{
    const AMOUNT = 'amount';

    const ACCOUNT = 'account';

    public function command(): ?string
    {
        return '/vbucks';
    }

    public function option($event, $predicate = null, $default = null)
    {
        $options = new Collection($event->getInteractionRequest()->all('options'));

        $value = $predicate
            ? $options->firstWhere($predicate)
            : $options;

        return $value ?? $default;
    }

    public function amount($event): int
    {
        $option = $this->option(
            $event,
            fn ($option) => $option['name'] === OnSlashVBucks::AMOUNT,
            0
        );

        return (int) $option['value'];
    }

    public function account($event): string
    {
        $option = $this->option(
            $event,
            fn ($option) => $option['name'] === OnSlashVBucks::ACCOUNT,
            ''
        );

        return (string) $option['value'];
    }

    public function discordId($event): ?string
    {
        $member = $event->getInteractionRequest()->all('member');

        return isset($member['user'])
            ? $member['user']['id']
            : null;
    }

    public function replyContent(ApplicationCommandInteractionEvent $event): ?string
    {
        $amount = $this->amount($event);
        $account = $this->account($event);
        $discordId = $this->discordId($event);

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

    public function behavior(ApplicationCommandInteractionEvent $event): int
    {
        // return static::LOAD_WHILE_HANDLING; // Shows a loading message/status while handling
        return static::REPLY_TO_MESSAGE; // Replies to the interaction with replyContent(). Required if you want to reply to the interaction
        // return static::DEFER_WHILE_HANDLING; // Shows no loading message/status while handling
    }

    public function handle(ApplicationCommandInteractionEvent $event): void
    {
        //
    }
}
