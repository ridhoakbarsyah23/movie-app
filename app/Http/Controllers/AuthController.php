<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        if ($request->username == 'aldmic' && $request->password == '123abc123') {
            session(['user' => 'aldmic']);
            return redirect()->route('movies');
        }

        return back()->with('error', 'Username atau Password salah!');
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login');
    }
}