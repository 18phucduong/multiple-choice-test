<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use \Illuminate\Auth\AuthenticationException;
use Closure;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('auth.login');
        }
    }
    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }
        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }
        return $this->unauthenticated($request, $guards);
    }
    protected function unauthenticated($request, array $guards): bool
    {
        if( in_array('api', $guards) ) {
            return false;
        }

        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectTo($request)
        );
    }
    public function handle($request, Closure $next, ...$guards)
    {
        $failedResponse = response()->json([
            'message' => 'The token was wrong or missed'
        ],401);
        $authenticated =  $this->authenticate($request, $guards);

        return $authenticated === false ? $failedResponse: $next($request);
    }
}
