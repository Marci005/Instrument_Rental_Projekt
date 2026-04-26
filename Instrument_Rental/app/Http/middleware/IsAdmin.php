<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Allows the request only if the authenticated user has is_admin = 1.
     * Returns 403 Forbidden otherwise.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user === null || (int) $user->is_admin !== 1) {
            return response()->json(['message' => 'Hozzáférés megtagadva.'], 403);
        }

        return $next($request);
    }
}
