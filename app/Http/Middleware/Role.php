<?php

namespace App\Http\Middleware;

use App\Enums\StatusCode;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated!'], StatusCode::HTTP_UNAUTHORIZED);
        }

        $allowedRoles = $roles;

        foreach ($allowedRoles as $role) {
            switch ($role) {
                case 'user':
                    if ($user->role == 0) {
                        return $next($request);
                    }
                    break;

                case 'admin':
                    if ($user->role == 1) {
                        return $next($request);
                    }
                    break;

                case 'manager':
                    if ($user->role == 2) {
                        return $next($request);
                    }
                    break;

                case 'staff':
                    if ($user->role == 3) {
                        return $next($request);
                    }
                    break;

                default:
                    return response()->json(['error' => "Invalid role specified: {$role}"], StatusCode::HTTP_BAD_REQUEST);
            }
        }

        return response()->json(['error' => 'Access denied! You do not have the necessary role.'], StatusCode::HTTP_FORBIDDEN);
    }
}