<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
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
         Gate::define('isTeacher', function ($user) {
        return $user->type_user == 1;
    });
     Gate::define('isStudent', function ($user) {
        return $user->type_user == 2;
    });
    }
}
