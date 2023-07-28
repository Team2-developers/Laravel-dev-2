<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class CheckTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Get Bearer token from the request
        $token = $request->bearerToken();

        if (!$token) {
            // No token provided in the request
            return response()->json([
                'message' => 'Token required'
            ], 401);
        }

        // Find user by token
        $user = User::where('token', $token)->first();

        if (!$user) {
            // No user found with the provided token
            return response()->json([
                'message' => 'Invalid token'
            ], 401);
        }

        if ($user->token_deadline < now()) {
            // Token has expired
            return response()->json([
                'message' => 'Token expired'
            ], 401);
        }

        // Everything is OK, continue to the next middleware/controller
        return $next($request);
    }
}
