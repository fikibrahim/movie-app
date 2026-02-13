<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if ($request->username == 'aldmic' && $request->password == '123abc123') {
            session(['login' => true]);
            return redirect('/movies');
        }

        return back()->with('error', 'Invalid username or password');
    }

    public function logout()
    {
        session()->forget('login');
        return redirect('/login');
    }
}
