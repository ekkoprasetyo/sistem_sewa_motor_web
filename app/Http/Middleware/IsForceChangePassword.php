<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class IsForceChangePassword
{
    public function handle($request, Closure $next)
    {
        $force_change_password = Session::get('user_force_change_password');
        if ($force_change_password == 1) {
            return redirect()->route('recover-password');
        }
        return $next($request);
    }
}
