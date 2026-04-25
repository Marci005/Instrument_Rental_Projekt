<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * GET /api/users
     * Returns all users in the system.
     * Admin-only endpoint.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(User::all());
    }

    /**
     * GET /api/users/{user}
     * Returns a specific user by ID.
     * Admin-only endpoint.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return response()->json($user);
    }

    /**
     * GET /api/users/{user}/rents
     * Returns all rents belonging to a specific user.
     * Admin-only endpoint.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function rents(User $user): JsonResponse
    {
        return response()->json(
            $user->rents()->with('instrument')->get()
        );
    }

    /**
     * POST /api/users/{user}/toggle-admin
     * Toggles the is_admin flag of a user between 0 and 1.
     * Admin-only endpoint.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function toggleAdmin(User $user): JsonResponse
    {
        $user->is_admin = $user->is_admin ? 0 : 1;
        $user->save();

        return response()->json($user);
    }

    /**
     * DELETE /api/users/{user}
     * Deletes a user from the system.
     * This also deletes related rents and addresses via cascade.
     * Admin-only endpoint.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json(['message' => 'User deleted successfully.']);
    }
}
