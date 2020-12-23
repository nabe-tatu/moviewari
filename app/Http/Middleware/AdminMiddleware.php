<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        //var_dump('before_middleware');
        if ($request->user()->admin === 1){
            //return redirect('admin');
            return response(view('admin'));
        }

        return $next($request);
    }
}
