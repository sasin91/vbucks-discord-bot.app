<?php

namespace App\Providers;

use App\Disord\DiscordCommands;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Nwilging\LaravelDiscordBot\Contracts\Services\DiscordApplicationCommandServiceContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $registerDiscordCommands = new DiscordCommands();
        $registerDiscordCommands->register(
            $this->app->make(DiscordApplicationCommandServiceContract::class)
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $shouldBeStrict = ! app()->isProduction();
        Model::preventLazyLoading($shouldBeStrict);
        Model::preventSilentlyDiscardingAttributes($shouldBeStrict);

        //Model::shouldBeStrict(! app()->isProduction());
        //Cashier::calculateTaxes();
    }
}
