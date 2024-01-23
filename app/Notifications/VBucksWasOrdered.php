<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Nwilging\LaravelDiscordBot\Contracts\Notifications\DiscordNotificationContract;
use Nwilging\LaravelDiscordBot\Support\Builder\ComponentBuilder;

class VBucksWasOrdered extends Notification implements DiscordNotificationContract
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Order $order)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['discord'];
    }

    public function toDiscord($notifiable): array
    {
        $componentBuilder = new ComponentBuilder();
        $componentBuilder->addLinkButton('Deliver', route('filament.admin.resources.orders.view', $this->order));

        return [
            'contentType' => 'rich',
            'channelId' => 'channel id',
            'components' => [
                $componentBuilder->getActionRow(),
            ],
        ];
    }
}
