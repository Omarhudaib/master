<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ApiAuthenticatedSessionController extends Controller
{
    /**
     * Handle user login (for API).
     */
    public function storeapp(LoginRequest $request): JsonResponse
    {
        // Validate the request data
        $validated = $request->validated();

        // Find the user by email
        $user = User::where('email', $validated['email'])->first();

        if ($user && Hash::check($validated['password'], $user->password)) {
            // Create the token
            $token = $user->createToken('YourAppName')->plainTextToken;

            // Return the token and role in the response
            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'role_id' => $user->role_id,
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }

    /**
     * Handle user logout (API).
     */
    public function destroyapp(Request $request): JsonResponse
    {
        // Revoke the token (logout the user)
        $user = $request->user(); // Get the authenticated user
        $user->tokens->delete(); // Delete all tokens associated with the user

        return response()->json([
            'message' => 'Logout successful',
        ]);
    }
}

