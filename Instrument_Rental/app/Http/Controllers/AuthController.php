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
    public function register(Request $request): JsonResponse
    {
        //validate the registering credentials
        $data = $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'title' => 'required|in:Úr,Hölgy, Dr., Professzor',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
        ]);

        $user = User::create($data);
        //Generates a unique id and searches for the matched user id
        Auth::login($user);

        //csrf token
        $request->session()->regenerate();
        //returns the user data and a 201 created status code
        return response()->json(['user' => $user], 201);
    }

    //login request
    public function login(Request $request): JsonResponse
    {
        //validates the login credentials
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        //If the authentication fails, throws an error, else:
        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['A megadott bejelentkezés nem  megfelelő!'],
            ]);
        }
        //else: starts the session
        $request->session()->regenerate();

        return response()->json(['user' => $request->user()]);
    }
    //logs out the user, terminates the session and regenerates the csrf session
    public function logout(Request $request)
    {
        Auth::Guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Sikeresen kijelentkeztél']);

    }

    //gives back the user data
    public function me(Request $request)
    {
        return response()->json($request->user());
    }



}
