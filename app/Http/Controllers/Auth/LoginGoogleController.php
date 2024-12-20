<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\NguoiDung;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginGoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = NguoiDung::where('ma_google', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);

                return redirect()->intended('/');
            } else {
                $newUser = NguoiDung::updateOrCreate(['email' => $user->email], [
                    'ten_nguoi_dung' => $user->name,
                    'ma_google' => $user->id,
                    'password' => encrypt('123456dummy'),
                    'ma_quyen' => 2,
                    'thoi_gian_xac_thuc_email' => now(),
                ]);

                Auth::login($newUser);

                return redirect()->intended('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
