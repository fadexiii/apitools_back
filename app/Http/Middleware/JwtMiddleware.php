<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Jwt;
use Mockery\Exception;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = '';
        if ($request->has('token')) {
            $token = $request->get('token');
        } else if ($request->hasHeader('token')) {
            $token = $request->header('token');
        }

        if ($token == '') {
            return result(-2, 'token错误');
        }
        Jwt::setToken($token);

        try {
            $user = Jwt::authenticate();
        } catch (Exception $e) {
            return result(-2, 'token错误');
        }

        return $next($request);
    }
}
