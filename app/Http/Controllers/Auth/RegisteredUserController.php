<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $user_array = $request->validated();

        $merge = [
            'role_id' => Role::where('name', 'customer')->first()->id,
        ];

        $request_user = array_merge($user_array, $merge);

        $user = User::create($request_user);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('verification.notice');
    }
}
