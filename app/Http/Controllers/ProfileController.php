<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Masmerise\Toaster\Toaster;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('pages.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $avatar_user = $request->user()->avatar;

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->hasFile('avatar')) {
            if ($avatar_user) {
                Storage::delete($avatar_user);
            }
            $imagePath = $request->file('avatar')->store(User::IMAGE_PATH);
        } else {
            $imagePath = $avatar_user;
        }

        $request->user()->avatar = $imagePath;

        $request->user()->save();

        Toaster::success('Profile updated successfully!');

        if ($request->user()->isAdmin()) {
            return Redirect::route('admin.dashboard.profile.edit')->with('status', 'profile-updated');
        }

        if ($request->user()->isCustomer()) {
            return Redirect::route('customer.dashboard.profile.edit')->with('status', 'profile-updated');
        }

        if ($request->user()->isSeller()) {
            return Redirect::route('seller.dashboard.profile.edit')->with('status', 'profile-updated');
        }

        return Redirect::route('dashboard.index')->with('status', 'profile-updated');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(PasswordUpdateRequest $request): RedirectResponse
    {

        $request->user()->update($request->only('password'));

        Toaster::success('Password updated successfully!');

        if ($request->user()->isAdmin()) {
            return Redirect::route('admin.dashboard.profile.edit')->with('status', 'password-updated');
        }

        if ($request->user()->isCustomer()) {
            return Redirect::route('customer.dashboard.profile.edit')->with('status', 'password-updated');
        }

        if ($request->user()->isSeller()) {
            return Redirect::route('seller.dashboard.profile.edit')->with('status', 'profile-updated');
        }

        return Redirect::route('dashboard.index')->with('status', 'password-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
