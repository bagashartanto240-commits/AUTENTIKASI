<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
public function store(Request $request): RedirectResponse
{
    // 1. Tambahkan validasi untuk field baru agar data di database tetap bersih
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255', 'unique:users'],
        'nim' => ['required', 'string', 'unique:users'], // Validasi NIM unik 2023
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
        'tempat_lahir' => ['required', 'string', 'max:255'], // Tambahkan validasi ini
        'tanggal_lahir' => ['required', 'date'], // Tambahkan validasi ini
        'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    // 2. Logika simpan foto (Silent Execution)
    // Berdasarkan kesepakatan, kita tidak menyimpan path ke DB agar registrasi lancar
    if ($request->hasFile('avatar')) {
        $file = $request->file('avatar');
        // File disimpan dengan nama username untuk memudahkan pemanggilan di dashboard
        $fileName = $request->username . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('avatars'), $fileName);
    }

    // 3. Penyimpanan data ke Database
    $user = User::create([
        'name' => $request->name,
        'username' => $request->username,
        'nim' => $request->nim, 
        'email' => $request->email,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'password' => Hash::make($request->password),
    ]);

    event(new Registered($user));
    Auth::login($user);

    return redirect(route('dashboard'));
}
}       