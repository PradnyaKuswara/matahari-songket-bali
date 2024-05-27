<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Masmerise\Toaster\Toaster;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            if (!auth()->user()->isAdmin()) {
                Toaster::error('Not found');

                return redirect()->back();
            } else {
                return $next($request);
            }
        } else {
            Toaster::error('Not found');

            return redirect()->back();
        }
    }
}