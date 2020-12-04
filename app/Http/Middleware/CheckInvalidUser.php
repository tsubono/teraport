<?php

namespace App\Http\Middleware;

use Closure;

class CheckInvalidUser
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
        if (auth()->check() && empty(auth()->user()->is_invalid)) {
          return $next($request);
        }
        abort(403, 'アカウントが制限されているため閲覧権限がありません。');
    }
}
