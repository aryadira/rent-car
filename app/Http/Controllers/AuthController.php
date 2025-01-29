<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'role' => 
        ]);
    }
}
