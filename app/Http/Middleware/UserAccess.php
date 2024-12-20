<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$userTypes)
    {
        if (in_array(auth()->user()->type, $userTypes)) {
            return $next($request);
        }

        return response()->json(['Anda Tidak ada izin untuk page in']);
    }
}