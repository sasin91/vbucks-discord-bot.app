<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class VerifyDiscordSignature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $signature = $request->header('X-Signature-Ed25519');
        $timestamp = $request->header('X-Signature-Timestamp');
        $body = $request->getContent();

        if (! $signature || ! $timestamp || ! $body) {
            throw new UnauthorizedHttpException('invalid request signature');
        }

        $data = sprintf('%s%s', $timestamp, $body);
        try {
            $verified = sodium_crypto_sign_verify_detached(
                hex2bin($signature),
                $data,
                hex2bin(config('discord.public_key'))
            );
        } catch (\SodiumException $exception) {
            throw new UnauthorizedHttpException('invalid request signature');
        }

        if (! $verified) {
            throw new UnauthorizedHttpException('invalid request signature');
        }

        return $next($request);
    }
}
