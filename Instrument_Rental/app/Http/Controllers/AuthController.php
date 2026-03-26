<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'title' => 'required|in:Úr,Hölgy, Dr., Professzor',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
        ]);
    }
}
