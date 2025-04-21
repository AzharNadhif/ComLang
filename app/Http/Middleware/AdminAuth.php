<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle(Request $request, Closure $next)
    {
        $admin = Admin::where('id_admin', session('admin_id'))->first();
        if (($admin && $admin->role !== 'admin')  || !session('admin_logged_in')) {
            return redirect()->route('login.show'); // Redirect to login if not authenticated as admin
        }
        
        return $next($request);
    }
}
