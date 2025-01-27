<?php

namespace App\Http\Controllers\Auth;

use App\Events\PasswordChanged;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ubah-password')->only(['edit', 'update']);
    }

    /**
     * Display the password update view.
     */
    public function edit(Request $request): View
    {
        return view('auth.change-password');
    }

    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:8', 'confirmed', 'different:current_password'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Re-authenticate the user after password change.
        $request->session()->regenerate();

        // Send the password change notification
        event(new PasswordChanged($request->user()));

        return back()
            ->with('status', 'password-updated')
            ->with('success', 'Password berhasil diubah.');
    }
}
