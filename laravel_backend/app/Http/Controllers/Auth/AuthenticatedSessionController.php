<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        
        $request->authenticate();

        $request->session()->regenerate();

        /**
         * @var \App\Models\User $user
         */
        $user = Auth::user();

        return response()->json([
            'user' => $user,
            'token' => $user->createToken($user->name)->plainTextToken,
        ]);;
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $user = $request->user();

        $user->tokens()->delete();

        return response()->json([
            'message' => 'Logged out',
        ]);
    }
}
