<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckWishlistOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route('id');
        error_log(auth()->user()->id);
        error_log($id);
        if (auth()->user() &&  auth()->user()->id === $id) {
            return $next($request);
        }

        return redirect('/dashboard');
    }
}
