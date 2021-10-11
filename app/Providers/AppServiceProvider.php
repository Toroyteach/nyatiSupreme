<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use ConsoleTVs\Charts\Registrar as Charts;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Charts $charts)
    {
        //
        Schema::defaultStringLength(191);

        $charts->register([
            \App\Charts\SampleChart::class
        ]);

        Paginator::useBootstrap();

        // $this->registerPolicies();

        // ResetPassword::createUrlUsing(function ($user, string $token) {
        //     return 'https://nyatisupreme.co.ke/reset-password?token='.$token;
        // });
    }
}
