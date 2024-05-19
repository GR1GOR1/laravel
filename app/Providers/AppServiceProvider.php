<?php

namespace App\Providers;

use App\Services\AddressParser\FakeParser;
use Illuminate\Support\ServiceProvider;

use App\Services\AddressParser\DadataParser;
use App\Services\AddressParser\ParserInterface;
use Dadata\DadataClient;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->singleton(ParserInterface::class, function(){
        //     return new DadataParser(new DadataClient(
        //         config('dadata.token'), 
        //         config('dadata.secret'))
        //     );
        // });

        $this->app->singleton(ParserInterface::class, function(){
            return new FakeParser();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /* \Illuminate\Support\Facades\DB::beforeExecuting(function($query, $params){
            echo '<div>';
            var_dump($query);
            var_dump($params);
            echo '<hr>';
            echo '</div>'; 
        }); */

        // \Illuminate\Support\Facades\DB::beforeExecuting(function($query, $params){
        //     Log::info("DB: $query with params " . json_encode($params));
        // });

        $blade = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();

        $blade->extend(function($value){
            $value = preg_replace('/---/', '<hr>', $value);
            return $value;
        });
    }
}
