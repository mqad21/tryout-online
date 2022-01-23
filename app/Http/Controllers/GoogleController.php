<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('');
        }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            // log them in
            Auth::login($existingUser);
        } else {
            // create a new user
            $newUser                  = new User();
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->google_id       = $user->id;
            $newUser->photo_url       = Helpers::getPhotoUrl($user->getAvatar());
            $newUser->is_verified     = true;
            $newUser->role_id         = Role::ALUMNI;
            $newUser->save();
            Auth::login($newUser);
        }
        return redirect('');
    }
}
