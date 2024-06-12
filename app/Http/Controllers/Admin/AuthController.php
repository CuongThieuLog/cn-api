<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusCode;
use App\Enums\TokenAbility;
use App\Http\Controllers\BaseController;
use App\Http\Requests\LoginRequest;
use App\Http\Services\Admin\AuthService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->only('email', 'password');
            $user = $this->authService->attemptLogin($credentials);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'errors' => ['error' => 'Your password is incorrect.']
                ], StatusCode::HTTP_UNAUTHORIZED);
            }

            $expirationTime = Carbon::now()->addMinutes(config('sanctum.ac_expiration'));
            $refreshExpirationTime = Carbon::now()->addMinutes(config('sanctum.rt_expiration'));

            $accessToken = $user->createToken('access_token', [TokenAbility::ACCESS_API->value], $expirationTime);
            $refreshToken = $user->createToken('refresh_token', [TokenAbility::ISSUE_ACCESS_TOKEN->value], $refreshExpirationTime);

            $success = [
                'access_token' => $accessToken->plainTextToken,
                'refresh_token' => $refreshToken->plainTextToken,
                'user' => $user,
            ];

            return response()->json([
                'success' => true,
                'data' => $success,
                'message' => 'Login account successfully.'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function logout(Request $request): JsonResponse
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Logout successfully.'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' =>  $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function me(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'User retrieved successfully.'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function refreshToken(Request $request): JsonResponse
    {
        try {
            $accessToken = $request->user()->createToken('access_token', [TokenAbility::ACCESS_API->value], Carbon::now()->addMinutes(config('sanctum.ac_expiration')));

            return response()->json([
                'success' => true,
                'data' => ['token' => $accessToken->plainTextToken],
                'message' => 'Token generated'
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}