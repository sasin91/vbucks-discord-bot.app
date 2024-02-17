<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
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
