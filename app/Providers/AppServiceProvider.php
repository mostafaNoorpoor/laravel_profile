<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Repository\ChatImplement ;
use App\Repository\ChatRepository ;

use App\Repository\UserRepository ;
use App\Repository\UserImplement ;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ChatRepository::class,
            ChatImplement::class
        );
        $this->app->bind(
            UserRepository::class,
            UserImplement::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
