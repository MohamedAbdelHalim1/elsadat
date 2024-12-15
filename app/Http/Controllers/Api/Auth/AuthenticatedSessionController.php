<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequestApi;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming login request for API.
     */
    public function store(LoginRequestApi $request)
    {
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate user and generate JWT token
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $user = auth()->user();

        // Generate a refresh token
        $refreshToken = JWTAuth::fromUser($user);

        return response()->json([
            'access_token' => $token,
            'refresh_token' => $refreshToken,
            'user' => $user,
        ]);
    }

    /**
     * Handle the refresh token request.
     */
    public function refresh(Request $request)
    {
        try {
            $refreshToken = $request->header('Authorization');

            if (!$refreshToken) {
                return response()->json(['error' => 'Refresh token is required'], 400);
            }

            // Parse and validate the refresh token
            $newToken = JWTAuth::refresh($refreshToken);

            return response()->json([
                'access_token' => $newToken,
            ]);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Invalid refresh token'], 401);
        }
    }

    /**
     * Handle the logout request for API.
     */
    public function destroy(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Successfully logged out']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to logout, please try again'], 500);
        }
    }
}
