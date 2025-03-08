<?php

namespace App\Providers;

use App\Http\Middleware\CheckUserType;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Registrar o middleware
        Route::aliasMiddleware('user.type', CheckUserType::class);
    }
}