<?php

namespace App\Http\Middleware;

use Closure;

class FormMiddleTrimMiddleware
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
        $input = $request->all();
        
        $trimmed = []; 
        foreach($input as $key => $val)
        {
            $trimmed[$key] = preg_replace("/( |　)/", "", $val );
        }
 
        $request->merge($trimmed);

        return $next($request);
    }
}
