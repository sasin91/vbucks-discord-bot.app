<?php

namespace App\Disord;

use App\Listeners\OnSlashVBucks;
use Nwilging\LaravelDiscordBot\Contracts\Services\DiscordApplicationCommandServiceContract;
use Nwilging\LaravelDiscordBot\Support\Commands\Options\IntegerOption;
use Nwilging\LaravelDiscordBot\Support\Commands\Options\StringOption;
use Nwilging\LaravelDiscordBot\Support\Commands\SlashCommand;

class DiscordCommands
{
    public function register(DiscordApplicationCommandServiceContract $appCommandService)
    {
        $slashVbucksCommand = new SlashCommand('vbucks', 'Buy VBucks');

        $slashVbucksCommand->option(new IntegerOption(OnSlashVBucks::AMOUNT, 'how many VBucks do you want?'));
        $slashVbucksCommand->option(new StringOption(OnSlashVBucks::ACCOUNT, 'account name of the recipent'));
        $appCommandService->createGlobalCommand($slashVbucksCommand);
    }
}
