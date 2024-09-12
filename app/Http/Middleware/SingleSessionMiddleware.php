<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SingleSessionMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $currentSessionId = session()->getId();
            $user->current_session_id = $currentSessionId;
            $user->save();
        }

        return $next($request);
    }
}
