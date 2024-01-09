<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class MicrosoftController extends Controller
{

    const MICROSOFT_TYPE = 'microsoft-graph';

    public function handleMicrosoftRedirect(){
        return Socialite::driver('microsoft-graph')->redirect();
    }

    public function handleMicrosoftCallback(){

            $user = Socialite::driver('microsoft-graph')->stateless()->user();

            // dd($user->id);

            $userExisted = User::where('oauth_id', $user->id)->where('oauth_type', 'microsoft-graph')->first();
            if ($userExisted) {
                Auth::login($userExisted);

                return redirect()->to('/');

            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'oauth_id' => $user->id,
                    'oauth_type' => static::MICROSOFT_TYPE,
                    'password' => Hash::make($user->password)

                ])->assignRole('Secretaria General');

                Auth::login($newUser);

                return redirect()->to('/');

            }
            
      
    }
}
