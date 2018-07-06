<?php

namespace App\Http\Middleware\Admin;

use Closure;

class UserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //判断session
        if (empty(session('user'))) {

            return redirect('/admin');
        }

        return $next($request);
    }
}
