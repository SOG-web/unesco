<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResetPassword extends Controller
{
    public function create()
    {
        return view('auth.auth', ['type' => 'reset-password']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        // send email with reset password link
        return redirect('/');
    }
}
