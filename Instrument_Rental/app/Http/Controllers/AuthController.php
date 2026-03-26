<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'title' => 'required|in:Úr,Hölgy, Dr., Professzor',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
        ]);

        $user = User::create($data);

        Auth::login($user);

        $request->session()->regenerate();

        return response()->json(['user' => $user], 201);
    }
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['A megadott bejelentkezés nem  megfelelő!'],
            ]);
        }

        $request->session()->regenerate();

        return response()->json(['user' => $request->user()]);
    }
    public function logout(Request $request)
    {
        Auth::Guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Sikeresen kijelentkeztél']);

    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }



}
