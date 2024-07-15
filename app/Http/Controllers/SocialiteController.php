<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Masmerise\Toaster\Toaster;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider): RedirectResponse
    {
        $user = Socialite::driver($provider)->user();

        $newUser = User::where('google_id', $user->getId())->first();

        if (! $newUser) {

            $usernameAlreadyExists = User::where('username', $user->getName())->exists();
            $emailAlreadyExists = User::where('email', $user->getEmail())->exists();

            if ($usernameAlreadyExists) {
                $usernameTemp = $user->getName().' '.rand(1, 1000);
            } else {
                $usernameTemp = $user->getName();
            }

            if ($emailAlreadyExists) {
                Toaster::error('Email already exists');

                return redirect()->route('login');
            }

            $newUser = User::create([
                'google_id' => $user->getId(),
                'name' => $user->getName(),
                'username' => $usernameTemp,
                'email' => $user->getEmail(),
                'password' => rand(1, 1000),
                'role_id' => Role::where('name', 'customer')->first()->id,
            ]);

            event(new Registered($newUser));
        }

        Auth::login($newUser, true);

        return redirect()->route('products.indexFront');
    }
}
