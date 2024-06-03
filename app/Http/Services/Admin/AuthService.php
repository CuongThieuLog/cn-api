<?php

namespace App\Http\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function attemptLogin($credentials)
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->is_active !== User::IS_ACTIVE['ACTIVE']) {
                throw new \Exception('Your account is not yet active.');
            }

            if ($user->role == User::ROLE['USER']) {
                throw new \Exception('You do not have access.');
            }

            return $user;
        }

        return null;
    }
}