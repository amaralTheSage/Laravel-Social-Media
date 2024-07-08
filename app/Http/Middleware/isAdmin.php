<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    // Replaced with the admin Gate, just keeping it here for reference
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        return $next($request);
    }
}
