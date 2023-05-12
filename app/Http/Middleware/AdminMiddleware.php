<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if ($user->role != "ADMIN") { // because USER is not ADMIN nor OWNER
            return response()->view('notfound');
        }
        return $next($request);
    }
}
