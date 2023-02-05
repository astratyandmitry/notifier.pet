<?php

namespace App\Http\Controllers\API;

use App\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        /** @var \App\Models\Admin $admin */
        $admin = Admin::query()->where('email', $request->email)->first();

        if (! $admin || ! Hash::check($request->password, $admin->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.',
            ], 401);
        }

        $token = $admin->createToken('api', ['admin'])->plainTextToken;

        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(): JsonResponse
    {
        /** @var \App\Models\Admin $admin */
        $admin = auth()->user();
        $admin->tokens()->delete();

        return response()->json([
            'message' => 'Logged out',
        ]);
    }
}
