<?php

namespace App\Helpers;

class CartHelper
{
    public static function getCartCount($user)
    {
        return $user->carts()->count();
    }
}
