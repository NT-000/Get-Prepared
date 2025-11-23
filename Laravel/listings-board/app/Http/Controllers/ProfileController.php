<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // update profile info
    // PUT /profile

    public function update(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $hasAvatarChange = false;

        if ($request->hasFile('avatar')) {

            if ($user->avatar) {
                Storage::delete('public/avatars/' . basename($user->avatar));
            }
            $validatedData['avatar'] = $request->file('avatar')->store('avatars', 'public');
            $hasAvatarChange = true;
        }

        $nameChanged = $user->name !== $validatedData['name'];
        $emailChanged = $user->email !== $validatedData['email'];

        if (!$nameChanged && !$emailChanged && !$hasAvatarChange) {
            return redirect()->route('dashboard.index')->with('error', 'No changes made.');
        }
        auth()->user()->update($validatedData);

        return redirect()->route('dashboard.index')->with('success', 'Profile updated successfully.');
    }

}
