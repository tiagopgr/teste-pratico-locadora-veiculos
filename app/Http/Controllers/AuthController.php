<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        $formuser = $request->except(['_token']);
        if (Auth::attempt($formuser, false)) {
            $request->session()->regenerate();

            return redirect()->route("dashboard.index");
        }

        return back()->withErrors([
            'auth' => 'Usuário e/ou senha incorretos.'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("auth.index");
    }
}
