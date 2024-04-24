<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $newUser = User::where('google_id', $user->getId())->first();

        if (! $newUser) {
            $newUser = User::create([
                'google_id' => $user->getId(),
                'name' => $user->getName(),
                'username' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => rand(1, 1000),
                'role_id' => Role::where('name', 'customer')->first()->id,
            ]);

            event(new Registered($newUser));
        }

        Auth::login($newUser, true);

        return redirect()->route('index');
    }
}
