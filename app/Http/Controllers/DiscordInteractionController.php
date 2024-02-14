<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Nwilging\LaravelDiscordBot\Contracts\Services\DiscordInteractionServiceContract;

class DiscordInteractionController
{
    public function __invoke(Request $request, DiscordInteractionServiceContract $interactionService)
    {
        logger()->info('payload', $request->json()->all());
        logger()->info('headers', $request->headers->all());

        $discordUser = $request->json('member.user', []);

        if (filled($discordUser) && User::query()->where('discord_id', $discordUser)->doesntExist()) {
            User::factory()->create([
                'discord_id' => $discordUser['id'],
                'name' => $discordUser['global_name'],
                'avatar' => sprintf(
                    'https://cdn.discordapp.com/avatars/%s/%s.%s',
                    $discordUser['id'],
                    $discordUser['avatar'],
                    preg_match('/a_.+/m', $discordUser['avatar']) === 1
                        ? 'gif'
                        : 'jpg'
                ),
            ]);
        }

        $response = $interactionService->handleInteractionRequest($request);

        return response()->json($response->toArray(), $response->getStatus());
    }
}
