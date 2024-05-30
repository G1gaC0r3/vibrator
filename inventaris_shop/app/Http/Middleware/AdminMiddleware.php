<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna saat ini memiliki peran 'admin'
        if(auth()->user() && auth()->user()->role == 'admin') {
            return $next($request);
        }

        // Jika tidak, arahkan pengguna ke halaman lain atau kembalikan respon yang sesuai
        return redirect()->route('home')->with('error', 'Unauthorized Access');
    }
}
