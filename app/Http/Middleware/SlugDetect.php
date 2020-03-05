<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SlugDetect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {       
        $slug = null; 
        if($request->route()->named('charity.index')){
            $slug = $request->charity->slug();                        
        }
        elseif($request->route()->named('sponsor.index')){            
            $slug = $request->sponsor->slug();            
        }
        if($slug){
            return redirect()->route('slug.fetch', ['slug' => $slug]);
        }

        return $next($request);
        
    }
}
