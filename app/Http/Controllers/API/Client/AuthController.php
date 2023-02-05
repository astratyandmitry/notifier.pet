<?php

namespace App\Http\Controllers\API\Client;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Client\LoginRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = User::query()->where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.',
            ], 401);
        }

        $token = $user->createToken('api', ['client'])->plainTextToken;

        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $user->tokens()->delete();

        return response()->json([
            'message' => 'Logged out',
        ]);
    }
}
