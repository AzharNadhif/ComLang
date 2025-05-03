<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login.form')->withErrors(['login' => 'Silahkan login terlebih dahulu.']);
        }

        return $next($request);
    }
}
