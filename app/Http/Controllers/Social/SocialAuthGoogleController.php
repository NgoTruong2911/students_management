<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Socialite;
use Auth;
use Carbon\Carbon;
use Exception;
use Spatie\Permission\Models\Role;

class SocialAuthGoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {

            $googleUser = Socialite::driver('google')->user();
            // dd($googleUser);
            // dd($googleUser->user->gender);
            $existUser = User::where('email', $googleUser->email)->first();
            if ($existUser) {
                Auth::loginUsingId($existUser->id);
            } else {
                $user = new User;
                $user->name = $googleUser->name;
                $user->email = $googleUser->email;
                $user->avatar = $googleUser->avatar;
                $user->google_id = $googleUser->id;
                $user->save();
                $user->assignRole('user');
                Auth::loginUsingId($user->id);

            }
            return redirect()->route('users.profile');
        } catch (Exception $e) {
            return 'error';
        }
    }


}
