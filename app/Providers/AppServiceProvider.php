<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
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
        Http::macro('petStore', function () {
            return Http::withHeaders([
                'Accept-Encoding' => 'application/json',
                'Content-Type' => 'application/json',
            ])->baseUrl(config('services.pet_store.base_url'));
        });
    }
}
