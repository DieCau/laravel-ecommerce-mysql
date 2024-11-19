<?php

namespace App\Providers;

use Carbon\Carbon;
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

    // Para que el mensaje de caducar cupon aparezca en español
    public function boot(): void
    {
        Carbon::setLocale('es');
    }
}
