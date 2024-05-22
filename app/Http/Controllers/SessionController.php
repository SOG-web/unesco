<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create(): View
    {
        return view('auth.auth', ['type' => 'login']);
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        $remember = $request->has('remember') && $request->remember === 'on';

        if (!auth()->attempt($validated, $remember)) {
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.',
            ]);
        }

        $request->session()->regenerate();

        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        auth()->logout();

        return redirect('/');
    }
}
