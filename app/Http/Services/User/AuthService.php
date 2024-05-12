<?php

namespace App\Http\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function attemptLogin($credentials)
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->is_active === User::IS_ACTIVE['ACTIVE']) {
                return $user;
            } else {
                throw new \Exception('Your account is not yet active.');
            }
        }
        return null;
    }
}