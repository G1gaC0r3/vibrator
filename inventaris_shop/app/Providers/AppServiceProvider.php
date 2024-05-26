<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $user = Auth::user();
            $profilePicture = $user ? $user->profile_picture : 'images/logo.png';
            $view->with('profilePicture', $profilePicture);
        });
    }
}
