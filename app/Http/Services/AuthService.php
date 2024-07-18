<?php

namespace App\Http\Services;

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

            if ($user->role !== User::ROLE['USER']) {
                throw new \Exception('Your account does not have permission to access this resource.');
            }

            return $user;
        }

        return null;
    }

    public function attemptLoginAdmin($credentials)
    {
        $listRole = [USER::ROLE['ADMIN'], User::ROLE['MANAGER'], User::ROLE['STAFF']];
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->is_active !== User::IS_ACTIVE['ACTIVE']) {
                throw new \Exception('Your account is not yet active.');
            }

            if (!in_array($user->role, $listRole)) {
                throw new \Exception('Your account does not have permission to access this resource.');
            }            

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