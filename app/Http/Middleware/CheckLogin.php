<?php

namespace App\Http\Middleware;

use Cache;
use Closure;
use App\MyTraits\Helper;

class CheckLogin
{
    use Helper;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $key = sprintf('user_%s_%s', $request->get('user_id'), $request->get('device'));
        if (($user = collect(Cache::get($key)))->isEmpty() || !($user['user_id'] ?? 0)) {
            return $this->result(collect(), '登陆超时或未登录', 102);
        }
        $request['user_id'] = $user['user_id'];

        return $next($request);
    }
}
