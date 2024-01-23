<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nwilging\LaravelDiscordBot\Contracts\Services\DiscordInteractionServiceContract;

class DiscordInteractionController
{
    public function __invoke(Request $request, DiscordInteractionServiceContract $interactionService)
    {
        $discordUserId = $request->json('member.user.id');

        if (filled($discordUserId)) {
            $user = User::query()
                ->where('discord_id', $discordUserId)
                ->firstOr(
                    fn () => User::factory()->create(['discord_id' => $discordUserId])
                );

            Auth::login($user);
        }

        $response = $interactionService->handleInteractionRequest($request);

        return response()->json($response->toArray(), $response->getStatus());
    }
}
