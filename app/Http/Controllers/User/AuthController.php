<?php

namespace App\Http\Controllers\User;

use App\Enums\TokenAbility;
use App\Http\Controllers\BaseController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\User\AuthService;
use App\Mail\RegisterMail;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $response = $this->sendResponse($success, 'User registered successfully.');

        $mailData = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp.'
        ];

        if ($response) {
            Mail::to($success['user']['email'])->send(new RegisterMail($mailData));
        }

        return $response;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $user = $this->authService->attemptLogin($credentials);

        if (!$user) {
            return $this->sendError('Unauthorized.', ['error' => 'Your password is incorrect.'], 401);
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

        return $this->sendResponse($success, 'Login account successfully.');
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return $this->sendResponse([], 'Logout successfully.');
    }

    public function me(Request $request): JsonResponse
    {
        $user = $request->user();

        return $this->sendResponse($user, 'User retrieved successfully.');
    }

    public function refreshToken(Request $request)
    {
        $accessToken = $request->user()->createToken('access_token', [TokenAbility::ACCESS_API->value], Carbon::now()->addMinutes(config('sanctum.ac_expiration')));
        return response(['message' => "Token generated", 'token' => $accessToken->plainTextToken]);
    }
}
