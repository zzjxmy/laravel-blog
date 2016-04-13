<?php

namespace App\Http\Middleware;

use Closure;

class LogMiddleware
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
        $reponse = $next($request);
		if($reponse->isOk() && \Auth::check()){
			\Log::info('11111111');
		}
		return $reponse;
    }
}
