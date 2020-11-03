<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuth
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
      // 注・・・ 0, null, false => trueとなるのではじく
        if (auth()->check() && empty(auth()->user()->is_admin) === false) {
          return $next($request);
        }
        abort(403, '管理者権限がありません。');
    }
}
