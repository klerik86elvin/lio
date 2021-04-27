<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmployeeGuard
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
    if(auth()->guard('employee_api') != null)
        auth()->shouldUse(auth()->guard('employee_api'));

    if (!Auth::guard('employee_api')->check())
        return response()->json(['message' => 'not authentication']);
    return $next($request);
}
}
