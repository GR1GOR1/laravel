<?php


/* can removed */

namespace App\Providers;

use Dadata\DadataClient;
use Illuminate\Support\ServiceProvider;

class DadataServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->singleton(DadataClient::class, function(){
            return new \Dadata\DadataClient(
                config('dadata.token'), config('dadata.secret'));
        });
    }

    public function boot(): void
    {
        //
    }
}
