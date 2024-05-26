<?php

// app/Http/Middleware/ShareProfilePicture.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class ShareProfilePicture
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $profilePicture = $user->profile_picture ?? 'images/logo.png';
        } else {
            $profilePicture = 'images/logo.png';
        }

        View::share('profilePicture', $profilePicture);
        return $next($request);
    }
}
