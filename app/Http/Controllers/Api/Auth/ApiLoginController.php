<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\RequestGuard;
use App\Models\User;
use Carbon\Carbon;

class ApiLoginController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    // Use 'web' guard which supports attempt()
    if (!Auth::guard('web')->attempt($credentials)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $user = Auth::guard('web')->user();

    // Update login timestamps
    $user->update([
        'last_login' => now(),
        'last_active_at' => now(),
    ]);

    // Generate Sanctum token
    return response()->json([
        'token' => $user->createToken('API Token')->plainTextToken,
        'user' => $user,
    ]);
}

}

