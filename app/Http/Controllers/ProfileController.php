<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ubah-profile')->only(['edit', 'update']);
        $this->middleware('permission:hapus-profile')->only(['destroy']);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('users.user_profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            $user->deleteImage($user->foto ?? null);
            // Simpan foto baru
            $user->foto = $user->uploadImage($request->file('foto'));
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('users-profile')
            ->with('status', 'profile-updated')
            ->with('success', 'Profile berhasil diubah.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')
            ->with('status', 'user-deleted')
            ->with('success', 'Akun berhasil dihapus.');
    }
}
