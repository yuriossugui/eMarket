<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login-form');
    }

    public function auth(Request $request)
    {
        $validated = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt($validated)){
            // generate new id session
            $request->session()->regenerate();
            return redirect()->intended('/admin/product-index');
        }else{
            return redirect()->back()->with('error', 'E-mail ou senha inválida.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
