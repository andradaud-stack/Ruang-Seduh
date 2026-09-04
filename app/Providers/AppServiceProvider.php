<?php

namespace App\Providers;

use App\Listeners\LogSuccessfullLogin;
use Illuminate\Auth\Events\Login;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
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
        if (config('app.env') === 'production' || isset($_SERVER['VERCEL']) || isset($_ENV['VERCEL']) || app()->environment('production')) {
            URL::forceScheme('https');
        }

        Event::listen(Login::class, LogSuccessfullLogin::class);

        Paginator::useBootstrapFive();
    }
}
