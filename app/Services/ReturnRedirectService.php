<?php

namespace App\Services;

use Illuminate\Http\Request;

class ReturnRedirectService
{
    public function routeString(Request $request, string $route): string
    {
        if ($request->user()->isAdmin()) {
            return 'admin.'.$route;
        }

        if ($request->user()->isSeller()) {
            return 'seller.'.$route;
        }

        return '404';
    }
}
