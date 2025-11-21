<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class RegisterController extends Controller
{

    // show register form
    // GET /register
    public function register(): View
    {
        return view('auth.register');
    }

    // store register form
    // POST /register
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'password_confirmation' => 'required|string|same:password',
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);

        return redirect()->route('login')->with('success', 'Registration successful!');

    }
}
