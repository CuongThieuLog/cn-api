<?php

namespace App\Http\Controllers\User;

use App\Enums\StatusCode;
use App\Enums\TokenAbility;
use App\Http\Controllers\BaseController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\User\AuthService;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $userData = $request->only('name', 'email', 'password');
        $user = $this->authService->register($userData);

        $expirationTime = Carbon::now()->addMinutes(config('sanctum.ac_expiration'));
        $refreshExpirationTime = Carbon::now()->addMinutes(config('sanctum.rt_expiration'));

        $accessToken = $user->createToken('access_token', [TokenAbility::ACCESS_API->value], $expirationTime);
        $refreshToken = $user->createToken('refresh_token', [TokenAbility::ISSUE_ACCESS_TOKEN->value], $refreshExpirationTime);

        $success = [
            'token' => $accessToken->plainTextToken,
            'refresh_token' => $refreshToken->plainTextToken,
            'user' => $user,
        ];

        event(new Registered($user));

        return response()->json([
            'success' => true,
            'data' => $success,
            'message' => 'User registered successfully. Please check your email to verify your account.'
        ], StatusCode::HTTP_CREATED);
    }

    public function login(LoginRequest $request): JsonResponse
    {
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
            'token' => $accessToken->plainTextToken,
            'refresh_token' => $refreshToken->plainTextToken,
            'user' => $user,
        ];

        return response()->json([
            'success' => true,
            'data' => $success,
            'message' => 'Login account successfully.'
        ], StatusCode::HTTP_OK);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout successfully.'
        ], StatusCode::HTTP_OK);
    }

    public function me(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User retrieved successfully.'
        ], StatusCode::HTTP_OK);
    }

    public function refreshToken(Request $request)
    {
        $accessToken = $request->user()->createToken('access_token', [TokenAbility::ACCESS_API->value], Carbon::now()->addMinutes(config('sanctum.ac_expiration')));

        return response()->json([
            'success' => true,
            'data' => ['token' => $accessToken->plainTextToken],
            'message' => 'Token generated'
        ], StatusCode::HTTP_OK);
    }

    public function verify(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'success' => true,
                'message' => 'Email already verified.'
            ], StatusCode::HTTP_OK);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json([
            'success' => true,
            'message' => 'Email has been verified.'
        ], StatusCode::HTTP_OK);
    }

    public function resendVerificationEmail(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'success' => true,
                'message' => 'Email already verified.'
            ], StatusCode::HTTP_OK);
        }

        $user->sendEmailVerificationNotification();

        return response()->json([
            'success' => true,
            'message' => 'Verification email sent.'
        ], StatusCode::HTTP_OK);
    }
}
