<?php

namespace App\Providers;

use App\Classes\FirstSms;
use App\Classes\SecondSms;
use App\Http\Controllers\SmsController;
use App\Interfaces\SMSInterface;
use Illuminate\Support\ServiceProvider;

class SmsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->when(SmsController::class)
          ->needs(SMSInterface::class)
          ->give(function () {
              return new FirstSms();
          });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
