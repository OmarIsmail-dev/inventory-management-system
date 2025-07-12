<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the request is from the app using the X-Platform header
        $isAppRequest = $request->header('X-Platform') === 'app';

        // Determine the allowed role based on the platform
        $allowedRole = $isAppRequest ? 'owner' : 'admin';

        $user = User::where('email', $request->email)->where('role', $allowedRole)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role, // Add role to the response
            ],
        ]);
    }
}
