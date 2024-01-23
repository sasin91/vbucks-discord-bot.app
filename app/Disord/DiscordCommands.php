<?php

namespace App\Disord;

use Nwilging\LaravelDiscordBot\Contracts\Services\DiscordApplicationCommandServiceContract;
use Nwilging\LaravelDiscordBot\Support\Commands\SlashCommand;

class DiscordCommands
{
    public function register(DiscordApplicationCommandServiceContract $appCommandService)
    {
        $slashVBucksCommand = $appCommandService->createGlobalCommand(
            new SlashCommand('vbucks', 'Buy VBucks')
        );
    }
}
