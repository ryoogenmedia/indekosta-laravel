<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Models\Kost;

class FortifyUIServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // for login view
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // for register view
        Fortify::registerView(function () {
            $kost = Kost::all();
            return view('auth.register-user', compact('kost'));
        });
    }
}
