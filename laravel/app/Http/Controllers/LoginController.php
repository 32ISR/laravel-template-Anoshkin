<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }
    
    public function store(Request $request) {
        $data = $request->validate([
            "email" => "required|email",
            "password" => "required|string"
        ]);

        if (!Auth::attempt($data, $request->boolean('remember_me'))) {
            return back()->withErrors([
                "email" => 'Неправильный email или пароль'
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }
}
