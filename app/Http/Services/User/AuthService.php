<?php

namespace App\Http\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function attemptLogin($credentials)
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->is_active !== User::IS_ACTIVE['ACTIVE']) {
                throw new \Exception('Your account is not yet active.');
            }

            // if (!$user->email_verified_at) {
            //     throw new \Exception('Your email is not verified.');
            // }

            return $user;
        }

        return null;
    }

    public function register(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
