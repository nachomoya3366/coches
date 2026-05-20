<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
        ])->save();

        return back()->with('success', 'Perfil actualizado correctamente.');
    }
}
