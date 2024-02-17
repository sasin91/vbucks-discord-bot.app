<?php

namespace App\Disord\Commands;

use App\Disord\Discord;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Http;
use RuntimeException;

abstract class DiscordCommand implements Responsable
{
    /**
     * The available types of application commands
     *
     * @see https://discord.com/developers/docs/interactions/application-commands#application-command-object-application-command-types
     */
    public const TYPE_CHAT_INPUT = 1;

    public const TYPE_USER = 2;

    public const TYPE_MESSAGE = 3;

    /**
     * The available command option types
     *
     * @see https://discord.com/developers/docs/interactions/application-commands#application-command-object-application-command-option-type
     */
    public const OPTION_TYPE_SUB_COMMAND = 1;

    public const OPTION_TYPE_SUB_COMMAND_GROUP = 2;

    public const OPTION_TYPE_STRING = 3;

    public const OPTION_TYPE_INTEGER = 4;

    public const OPTION_TYPE_BOOLEAN = 5;

    public const OPTION_TYPE_USER = 6;

    public const OPTION_TYPE_CHANNEL = 7;

    public const OPTION_TYPE_ROLE = 8;

    public const OPTION_TYPE_MENTIONABLE = 9;

    public const OPTION_TYPE_NUMBER = 10;

    public const OPTION_TYPE_ATTACHMENT = 11;

    /**
     * The available response types
     *
     * @see https://discord.com/developers/docs/interactions/receiving-and-responding#interaction-response-object
     */
    public const RESPONSE_TYPE_PONG = 1;

    public const RESPONSE_TYPE_CHANNEL_MESSAGE_WITH_SOURCE = 4;

    public const RESPONSE_TYPE_DEFERRED_CHANNEL_MESSAGE_WITH_SOURCE = 5;

    public const RESPONSE_TYPE_DEFERRED_UPDATE_MESSAGE = 6;

    public const RESPONSE_TYPE_UPDATE_MESSAGE = 7;

    public const RESPONSE_TYPE_APPLICATION_COMMAND_AUTOCOMPLETE_RESULT = 8;

    public const RESPONSE_TYPE_MODAL = 9;

    public function applicationId(): string
    {
        return config('discord.application_id');
    }

    abstract public function type(): int;

    public function name(): string
    {
        return class_basename(static::class);
    }

    public function description(): ?string
    {
        return null;
    }

    public function options(): array
    {
        return [];
    }

    public function register(): void
    {
        $payload = [
            'type' => $this->type(),
            'name' => $this->name(),
            'description' => $this->description(),
            'application_id' => $this->applicationId(),
            'options' => ! empty($this->options()) ?: null,
        ];

        $payload = array_filter($payload);

        $response = $this->request()->post(
            $this->url('commands'),
            $payload
        );

        if (! $response->ok()) {
            throw new RuntimeException($response->body(), $response->status());
        }
    }

    public function request()
    {
        return Http::asJson()
            ->withToken(config('discord.token'), 'bot')
            ->baseUrl(config('discord.api_url'));
    }

    public function url(string $uri): string
    {
        return sprintf(
            'applications/%s/applications/%s',
            config('discord.application_id'),
            $uri
        );
    }
}
