<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function store()
    {
        $validated = request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = User::create($validated);

        $remember = request()->has('remember') && request()->remember === 'on';

        Auth::login($user, $remember);

        return redirect('/dashboard');
    }

    public function create()
    {
        return view('auth.auth', ['type' => 'register']);
    }
}
