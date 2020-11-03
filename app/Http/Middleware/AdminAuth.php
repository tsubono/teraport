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
      // 注・・・本番DBの仕様により 1 => true
        if (auth()->check() && auth()->user()->is_admin === 1) {
          return $next($request);
        }
        abort(403, '管理者権限がありません。');
    }
}
