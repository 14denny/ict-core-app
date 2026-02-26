<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HakAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // not logged in?
        if (!$request->session()->has('username')) {
            return redirect(route('auth.form'));
        }

        // check access to menu
        $path = $request->path();

        $filtered = array_filter($request->session()->get('all_akses'), function ($item) use ($path) {
            return str_starts_with($path, $item);
        }); // filter array starts with $path

        if(!$filtered){
            return abort(403);
        }

        return $next($request);
    }
}
