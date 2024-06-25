<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyEmailCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            if ($request->user()->role->name == 'customer' && ! $request->user()->hasVerifiedEmail()) {
                return redirect()->route('verification.notice');
            } else {
                return $next($request);
            }
        } else {
            return $next($request);
        }
    }
}
