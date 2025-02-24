<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdminOrModerator
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        // Admin or Moderator access
        if ($user && ($user->user_type === 'admin' || $user->user_type === 'moderator')) {
            return $next($request);
        }
        abort(403, 'Unauthorized access.');
    }
}
