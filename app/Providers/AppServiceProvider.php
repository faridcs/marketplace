<?php

namespace App\Providers;

use App\Services\Sms\SmsService;
use App\Services\Sms\SmsServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param Application $application
     */
    public function boot(Application $application)
    {
        Carbon::setLocale('fa');
        Schema::defaultStringLength(191);

        $application->singleton(SmsServiceInterface::class, SmsService::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
