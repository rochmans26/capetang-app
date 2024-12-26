<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('landing_page');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param RegisterRequest $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $request->merge([
            'password' => Hash::make($request->password),
            'status' => 1
        ]);

        $user = User::create($request->all());

        // Upload foto
        if ($request->hasFile('foto')) {
            $user->foto = $user->uploadFoto($request->file('foto'));
            $user->save();
        }

        // Tambahkan role user dan sync permissionnya
        $role = Role::where('name', 'user')->first();
        $user->assignRole($role->name);
        $user->syncPermissions($role->permissions);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
