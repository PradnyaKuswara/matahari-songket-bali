<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            if (auth()->user()->role->name != 'customer') {
                //check to json or not
                if ($request->expectsJson()) {
                    return response()->json(['message' => 'Not found'], 404);
                }

                return redirect()->back();
            } else {
                return $next($request);
            }
        } else {
            //check to json or not
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Not found'], 404);
            }

            return redirect()->back();
        }
    }
}
