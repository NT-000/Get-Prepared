<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // update profile info
    // PUT /profile

    public function update(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string',
        ]);
        auth()->user()->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully.');
    }

}
