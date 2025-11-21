<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    // show login form
    // GET /login
    public function login(): View
    {
        return view('auth.login');
    }

    // authenticate user
    // POST /login
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|string|email|max:100',
            'password' => 'required|string',
        ]);
        // dd($credentials);
        if (Auth::attempt($credentials)) {
            // regenerate the session
            $request->session()->regenerate();
            return redirect()->intended(route('home'))->with('success', 'Login success!');
        }
        // if auth fails redirect back with error
        return back()->withErrors(
            [
                'email' => 'The credentials are wrong.'
            ]
        )->onlyInput('email');
    }
}
