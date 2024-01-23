<?php

namespace App\Listeners;

use App\Data\CheckoutData;
use App\Data\VBuckData;
use App\Features\OrderPayments;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Nwilging\LaravelDiscordBot\Contracts\Listeners\ApplicationCommandInteractionEventListenerContract;
use Nwilging\LaravelDiscordBot\Events\ApplicationCommandInteractionEvent;

class OnSlashVBucks implements ApplicationCommandInteractionEventListenerContract
{
    public function command(): ?string
    {
        return '/vbucks';
    }

    public function amount($event): int
    {
        return $event->getInteractionRequest()->getInt('amount');
    }

    public function character($event): string
    {
        return $event->getInteractionRequest()->getString('character');
    }

    public function replyContent(ApplicationCommandInteractionEvent $event): ?string
    {
        $amount = $this->amount($event);
        $characterName = $this->character($event);

        if ($amount <= 0) {
            return 'How many do you want?';
        }

        if (blank($characterName)) {
            return 'Which character do you want to receive the vbucks?';
        }

        $order = Order::fromCheckoutData(
            CheckoutData::from(
                vbucks: VBuckData::collection([
                    [
                        'character_name' => $characterName,
                        'amount' => $amount,
                    ],
                ]),
                customer: Auth::user()
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
                $characterName
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
