<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                'confirmed',
                'max:16',
                Password::min(8)->letters()->mixedCase()->numbers()->symbols(),
                function ($attribute, $value, $fail) use ($request) {
                    if (Hash::check($value, $request->user()->password)) {
                        $fail('La nueva contraseña no puede ser igual a la actual.');
                    }
                },
            ],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Contraseña actualizada correctamente.');
    }
}
